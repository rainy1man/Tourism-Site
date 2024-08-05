<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserDetailResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->user()->can('see.user')) {
            $users = new User();
            $users = $users->orderBy('id', 'desc')->paginate(10);
            return UserDetailResource::collection($users);
        } else {
            return $this->responseService->unauthorized_response();
        }
    }

    //
    public function store(Request $request)
    {
        if ($request->user()->can('create.user')) {
            $national_code = $request->input('national_code');
            $password = Hash::make($national_code);
            $user = User::create($request->merge(["password" => $password])->toArray());
            $user->assignRole('user');
            return UserDetailResource::make($user);
        } else {
            return $this->responseService->unauthorized_response();
        }
    }

    //
    public function show(Request $request, string $id)
    {
        if ($request->user()->can('see.user')) {
            $user = User::find($id);
            return UserDetailResource::make($user);
        } else {
            return $this->responseService->unauthorized_response();
        }
    }

    //
    public function update(Request $request, string $id)
    {
        if ($request->user()->can('update.user')) {
            $user = User::where('id', $id)->update($request->merge(["password" => Hash::make($request->password)])->toArray());
            return UserDetailResource::make($user);
        } else {
            return $this->responseService->unauthorized_response();
        }
    }

    //
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
        $user = User::find(Auth::id());
        $input = $request->except(['password']);
        $user->update($input);
        return UserDetailResource::make($user);
    }

}
