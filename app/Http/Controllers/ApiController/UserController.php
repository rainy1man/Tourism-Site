<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index (){
        $user = User::get();
        return response()->json($user);
    }

    public function store (Request $request){
        $user = User::create($request->toArray());
        return response()->json($user);
    }

    public function edit (Request $request,$id){
        $user = User::where('id',$id)->update($request->toArray());
        return response()->json($user);
    }

    public function delete (Request $request,$id){
        $user = User::destroy($id);
        return response()->json($user);
    }

    public function login (Request $request){
        $user = User::where('email', $request->email)
            ->first();
        if (!$user) {
            return response()->json('user not found');
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json('pass eror');
        }

        $token = $user->createToken($request->email)->plainTextToken;

        return response()->json(["token" => $token]);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json('logged out');

    }
}
