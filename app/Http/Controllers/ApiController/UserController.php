<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->user()->can('see.user')) {
            $users = new User();
            $users = $users->orderBy('id', 'desc')->paginate(10);
            return $this->responseService->success_response($users);
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
            return $this->responseService->success_response($user);
        } else {
            return $this->responseService->unauthorized_response();
        }
    }

    //
    public function show(Request $request, string $id)
    {
        if ($request->user()->can('see.user') || $request->user()->id == $id) {
            $user = User::find($id);
            return $this->responseService->success_response($user);
        } else {
            return $this->responseService->unauthorized_response();
        }
    }

    //
    public function update(Request $request, string $id)
    {
        if ($request->user()->can('update.user') || $request->user()->id == $id) {
            $user = User::where('id', $id)->update($request->merge(["password" => Hash::make($request->password)])->toArray());
            return $this->responseService->success_response($user);
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
}
