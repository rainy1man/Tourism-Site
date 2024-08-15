<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Jobs\ResetPasswordSMS;
use App\Models\Code;
use App\Models\ResetPassword;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function request_reset_password(Request $request)
    {
        $request->validate(['phone_number' => 'required']);

        $user = User::where('phone_number', $request->phone_number)->first();
        if (!$user) {
            return $this->responseService->notFound_response('کاربر');
        }

        Code::where('user_id', $user->id)->delete();

        $code = rand(1000, 9999);
        $expires_at = Carbon::now()->addMinutes(2);

        Code::create([
            'user_id' => $user->id,
            'code' => $code,
            'expires_at' => $expires_at,
        ]);

        ResetPasswordSMS::dispatch($user, $code);

        session(['user_id' => $user->id]);
        return response()->json(['message' => 'کد ارسال شد']);
    }

    public function verify_reset_password_code(Request $request)
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
        return response()->json(['message' => 'کد تایید شد']);
    }

    public function reset_password(Request $request)
    {
        $request->validate(['new_password' => ['required', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'confirmed']]);

        $user_id = session('user_id');
        $verified_code = session('verified_code');

        if (!$user_id || !$verified_code) {
            return response()->json(['error' => 'دوباره تلاش کنید']);
        }

        $code = Code::where('user_id', $user_id)
            ->where('code', $verified_code)
            ->first();

        $user = User::find($user_id);
        $user->password = $request->password;
        $user->save();

        $code->delete();
        $request->session()->forget(['user_id', 'verified_code']);

        return response()->json(['message' => 'رمز عبور با موفقیت تغییر کرد']);
    }
}
