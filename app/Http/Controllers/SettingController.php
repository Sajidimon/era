<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class SettingController extends Controller
{

    //this method will display user settings;
    public function settings()
    {
        $settings = Setting::first();
        return Inertia::render('Admin/Settings', [
            'settings' => $settings
        ]);
    }

    //this method will update settings;
    public function updateSettings(Request $request)
    {
        $request->validate([
            'disabled_registration' => 'nullable|boolean',
        ]);

        $setting = Setting::first();

        if($setting){
            $setting->update([
                'disabled_registration' => $request->input('disabled_registration')
            ]);
        }else{
            Setting::create([
                'disabled_registration' => $request->input('disabled_registration')
            ]);
        }
    }

    //this method will display error page;
    public function error()
    {
        return Inertia::render('User/404');
    }

}
