<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use Session;

class SettingController extends Controller
{
    public function aplikasi()
    {
    	  $setting = Setting::paginate(25);

        return view('setting.aplikasi', compact('setting'));
    }

    public function updatea(Request $request)
    {
    	   $requestData = $request->all();
        foreach ($requestData as $key => $value) {
            if($key != '_token'){
                Setting::where('setting_name',$key)->update(['setting_value'=>$value]);
            }
        }

        Session::flash('flash_message', 'Setting added!');

        return redirect(route('aplikasi'));
    }
}
