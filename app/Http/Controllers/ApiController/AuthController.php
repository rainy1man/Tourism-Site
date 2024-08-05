<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AuthController extends Controller
{

    public function register(Request $request)
    {
        $phone_number = User::where('phone_number', $request->phone_number)->first();
        if ($phone_number) {
            // send code
        } else {
            $user = User::create($request->toArray());
            $user->assignRole('user');
            return $this->responseService->success_response($user);
        }
    }

    public function login(Request $request)
    {
        $user = User::where('phone_number', $request->phone_number)
            ->orWhere('email', $request->email)->first();

        if (!$user) {
            return $this->responseService->notFound_response('کاربر');
        }
        if (!Hash::check($request->password, $user->password)) {
            return $this->responseService->error_response('رمز عبور اشتباه است');
        }
        $token = $user->createToken($request->phone_number or $request->email)->plainTextToken;
        return response()->json(['token' => $token]);
    }

    public function logout(Request $request)
    {
        auth()->user()->currentAccessToken()->delete();
        return response()->json("از سامانه خارج شدید");
    }

}
