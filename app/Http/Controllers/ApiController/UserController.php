<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Http\Resources\UserDetailResource;
use App\Models\Passenger;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->can('see.user')) {
            $users = new User();
            if ($request->has('filter')) {
                $users = $users->where('first_name', 'like', '%' . $request->input('filter') . '%')
                    ->orwhere('last_name', 'like', '%' . $request->input('filter') . '%')
                    ->orwhere('phone_number', 'like', '%' . $request->input('filter') . '%')
                    ->orWhere('national_code', 'like', '%' . $request->input('filter') . '%');
            }
            $users = $users->orderBy('id', 'desc')->paginate(10);
            return UserDetailResource::collection($users);
        } else {
            return $this->responseService->unauthorized_response();
        }
    }

    public function store(Request $request)
    {
        if ($request->user()->can('create.user')) {
            $user = User::create($request->toArray());
            $user->assignRole('user');
            Passenger::create($request->merge(["user_id" => $user->id])->toArray());
            return UserDetailResource::make($user);
        } else {
            return $this->responseService->unauthorized_response();
        }
    }

    public function show(Request $request, string $id)
    {
        if ($request->user()->can('see.user')) {
            $user = User::find($id);
            return UserDetailResource::make($user);
        } else {
            return $this->responseService->unauthorized_response();
        }
    }

    public function update(Request $request, string $id)
    {
        if ($request->user()->can('update.user')) {
            $user = User::where('id', $id)->update($request->merge(["password" => Hash::make($request->password)])->toArray());
            $user = User::find($id);
            return UserDetailResource::make($user);
        } else {
            return $this->responseService->unauthorized_response();
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($request->user()->can('delete.user')) {
            User::destroy($id);
            return $this->responseService->delete_response('کاربر');
        } else {
            return $this->responseService->unauthorized_response();
        }
    }

    public function profile(Request $request)
    {
        $user = User::find(Auth::id());
        return UserDetailResource::make($user);
    }

    public function update_profile(Request $request)
    {
        $user = Auth::user();
        $password = $user->password;
        // $data = $request->validated();
        if (!$password) {
            $data = $request->except(['phone_number']);
            $data['password'] = Hash::make($request->password);
            $user->update($data);
            Passenger::create($request->merge(["user_id" => $user->id])->toArray());
        } else {
            $data = $request->except(['password', 'phone_number']);
            $user->update($data);
        }
        return UserDetailResource::make($user);
    }
}
