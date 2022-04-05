<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Setting;

use Session;

class SettingsController extends Controller
{
    public function lockOrder() {

        $setting = Setting::where('lock', 'no')->first();
        $setting->lock = 'yes';
        $setting->save();

        Session::flash('success', 'All Order has been locked.');

        return redirect()->back();

    }


}
