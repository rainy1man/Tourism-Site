<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Jobs\RegisterSMS;
use App\Jobs\ResetPasswordSMS;
use App\Models\Code;
use App\Models\ResetPassword;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function request_reset_password(Request $request)
    {
        $request->validate(['phone_number' => 'required']);

        $user = User::where('phone_number', $request->phone_number)->first();

        if (!$user) {
            return $this->responseService->notFound_response('کاربر');
        }

        $codes = Code::where('user_id', $user->id)
            ->where('expires_at', '>', Carbon::now())
            ->first();
        if (!$codes) {
            Code::where('user_id', $user->id)->delete();
            $code = rand(1000, 9999);
            $expires_at = Carbon::now()->addMinutes(3);
            $verification_token = Str::random(40);
            Code::create([
                'user_id' => $user->id,
                'code' => $code,
                'expires_at' => $expires_at,
                'verification_token' => $verification_token,
            ]);
        } else {
            return $this->responseService->error_response('بعد از منقضی شدن کد تلاش کنید');
        }

        ResetPasswordSMS::dispatch($user, $code);

        return response()->json([
            'message' => 'کد ارسال شد',
            'verification_token' => $verification_token
        ]);
    }

    public function verify_reset_password_code(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:4',
            'verification_token' => 'required'
        ]);

        $code = Code::where('verification_token', $request->verification_token)
            ->where('code', $request->code)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$code) {
            return $this->responseService->error_response('کد نادرست یا منقضی شده');
        }

        $code->delete();

        return response()->json([
            'message' => 'کد تایید شد',
            "user_id" => $code->user_id
        ]);
    }

    public function reset_password(Request $request)
    {
        $request->validate(['new_password' => ['required', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'confirmed']]);

        $user_id = $request->user_id;
        $user = User::find($user_id);
        $user->password = $request->new_password;
        $user->save();

        return response()->json(['message' => 'رمز عبور با موفقیت تغییر کرد']);
    }
}
