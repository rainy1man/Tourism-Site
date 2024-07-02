<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $favorite = Favorite::get();
        return response()->json($favorite);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $favorite = Favorite::create($request->toArray());
        return response()->json($favorite);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $favorite = Favorite::find($id);
        if (!$favorite) {
            return response()->json(['message' => 'Favorite not found'], 404);
        }
        return response()->json($favorite);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $favorite = Favorite::find($id);

        // اگر favorite پیدا نشد، خطای 404 برگردانید
        if (!$favorite) {
            return response()->json(['message' => 'Favorite not found'], 404);
        }

        // به‌روزرسانی favorite با داده‌های ورودی
        $favorite->update($request->toArray());

        // برگرداندن اطلاعات به‌روزرسانی شده
        return response()->json($favorite);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $favorite = Favorite::find($id);

        // اگر favorite پیدا نشد، خطای 404 برگردانید
        if (!$favorite) {
            return response()->json(['message' => 'Favorite not found'], 404);
        }

        // برای حذف favorite با داده‌های ورودی
        $favorite->delete();

        // برگرداندن اطلاعات به‌روزرسانی شده
        return response()->json(['message' => 'Favorite deleted successfully']);
    }
}
