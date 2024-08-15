<?php

namespace App\Http\Controllers\ApiController;

use App\Jobs\RegisterSMS;
use App\Models\Code;
use App\Models\Passenger;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Resources\UserDetailResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function request_register(Request $request)
    {
        $request->validate(['phone_number' => 'required']);

        $user = User::where('phone_number', $request->phone_number)->first();

        if ($user) {
            $codes = Code::where('user_id', $user->id)
                ->where('expires_at', '>', Carbon::now())
                ->first();
            if (!$codes) {
                Code::where('user_id', $user->id)->delete();
                $code = rand(1000, 9999);
                $expires_at = Carbon::now()->addMinutes(5);
                Code::create([
                    'user_id' => $user->id,
                    'code' => $code,
                    'expires_at' => $expires_at,
                ]);
            } else {
                return $this->responseService->error_response('بعد از منقضی شدن کد تلاش کنید');
            }
        }

        if (!$user) {
            $request->validate(['phone_number' => 'required']);
            $user = User::create($request->toArray());
            $user->assignRole('user');
            $code = rand(1000, 9999);
            $expires_at = Carbon::now()->addMinutes(2);
            Code::create([
                'user_id' => $user->id,
                'code' => $code,
                'expires_at' => $expires_at,
            ]);
        }

        RegisterSMS::dispatch($user, $code);
        session(['user_id' => $user->id]);
        return response()->json(['message' => 'کد ارسال شد']);
    }

    public function verify_register_code(Request $request)
    {
        $request->validate(['code' => 'required|digits:4']);

        $user_id = session('user_id');
        if (!$user_id) {
            return $this->responseService->error_response('دوباره تلاش کنید');
        }

        $code = Code::where('user_id', $user_id)
            ->where('code', $request->code)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$code) {
            return $this->responseService->error_response('کد نادرست یا منقضی شده');
        }

        session(['verified_code' => $request->code]);

        $user = User::find($user_id);
        $token = $user->createToken($user->phone_number)->plainTextToken;
        return response()->json([
            'token' => $token,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'role' => $user->roles()->select(['id', 'name'])->get()->makeHidden('pivot')
        ]);    }

    public function login(Request $request)
    {
        $user = User::where('phone_number', $request->phone_number)
            ->orWhere('email', $request->phone_number)->first();

        if (!$user) {
            return $this->responseService->notFound_response('کاربر');
        }
        if (!Hash::check($request->password, $user->password)) {
            return $this->responseService->error_response('رمز عبور اشتباه است');
        }
        $token = $user->createToken($request->phone_number)->plainTextToken;
        return response()->json([
            'token' => $token,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'role' => $user->roles()->select(['id', 'name'])->get()->makeHidden('pivot')
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return response()->json(['message' => "از سامانه خارج شدید"]);
    }

    public function change_password(Request $request)
    {
        $request->validate([
            'new_password' => ['required', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'confirmed'],
            'password' => 'required'
        ]);

        $user = Auth::user();

        if (Hash::check($request->password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);
            $user->tokens()->delete();
            return $this->responseService->success_response();
        } else {
            return $this->responseService->error_response('رمز عبور اشتباه است');
        }
    }
}
