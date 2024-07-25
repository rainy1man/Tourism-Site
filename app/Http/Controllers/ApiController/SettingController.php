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
        $settings = Setting::all();
        return view('settings.index', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $setting = Setting::findOrFail($id);

        if ($request->hasFile('logo')) {

            $setting->clearMediaCollection('logos');
            $setting->addMedia($request->file('logo'))->toMediaCollection('logos');
        }

        $setting->value = $request->input('value');
        $setting->save();

        return redirect()->route('settings.index')->with('success', 'Setting updated successfully');
    }

    public function resetDefaults()
    {
        $default_settings = [
            'contact_address' => 'آدرس',
            'contact_phone' => 'شماره تماس',
            'contact_email' => 'ایمیل',
            'customer_faq' => 'سوالات متداول',
            'customer_support' => 'مرکزپشتیبانی',
            'customer_about' => 'درباره ما',
            'popular_north_tours' => 'تورهای شمال',
            'popular_international_tours' => 'تورهای خارجی',
            'popular_desert_tours' => 'تورهای کویر',
            'logo' => '',
            'social_instagram' => 'Instagram',
            'social_twitter' => 'Twitter',
            'social_youtube' => 'YouTube',
            'social_linkedin' => 'LinkedIn',
        ];

        foreach ($default_settings as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if ($setting) {
                $setting->value = $value;
                $setting->save();
            }
        }

        return redirect()->route('settings.index')->with('success', 'Settings reset to defaults');
    }

}
