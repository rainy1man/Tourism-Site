<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::all();
        return response()->json($setting);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $setting = Setting::create($request->toArray());
        return response()->json($setting);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $setting = Setting::find($id);
        if(!$setting) {
            return response()->json(['message' => 'Setting not found'], 404);
        }
        return response()->json($setting);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $setting = Setting::find($id);
        if(!$setting) {
            return response()->json(['message' => 'Setting not found'], 404);
        }
        $setting->update();
        return response()->json($setting);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $setting = Setting::find($id);
        if(!$setting) {
            return response()->json(['message' => 'Setting not found'], 404);
        }
        $setting->delete();
        return response()->json(['message' => 'Setting deleted successfully']);
    }
}
