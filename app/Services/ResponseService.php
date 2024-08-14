<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class ResponseService
{
    public function success_response($data = "", string $message = "عملیات با موفقیت انجام شد"): JsonResponse
    {
        return response()->json([
            "success" => 'success',
            "message" => $message,
            "data" => $data
        ]);
    }

    public function error_response(string $message = "عملیات ناموفق"): JsonResponse
    {
        return response()->json([
            "success" => 'error',
            "message" => $message,
            "data" => ''
        ]);
    }

    public function unauthorized_response(string $message = "مجوز دسترسی به این بخش را ندارید"): JsonResponse
    {
        return response()->json([
            "success" => 'error',
            "message" => $message,
            "data" => ''
        ]);
    }

    public function delete_response(string $data = "دیتا"): JsonResponse
    {
        return response()->json([
            "success" => 'success',
            "message" => $data . ' ' . 'با موفقیت حذف شد',
        ]);
    }

    public function notFound_response(string $data = "دیتا"): JsonResponse
    {
        return response()->json([
            "success" => 'error',
            "message" => $data . ' ' . 'یافت نشد',
        ]);
    }
}
