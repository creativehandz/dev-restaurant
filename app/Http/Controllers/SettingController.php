<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Response;

class SettingController extends Controller
{

    public function index()
    {
        //get setting data
        $settings = Settings::get();
        return view('setting.setting-list', compact('settings'));
    }

    public function store(Request $request)
    {
        // $valdi = $request->validate(
        //     [
        //         'phone' => 'required',
        //         'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
        //         'address' => 'required',
        //         'facebook' => 'required',
        //         'tiktok' => 'required',
        //         'instagram' => 'required',
        //         'whatsapp' => 'required',
        //         'google_review' => 'required',
        //         'location' => 'required',
        //         'time_schedule' => 'required'
        //     ]
        // );

        //if (true) {
            $time_schedule_input = [
                'monday' => [
                    'start_time' => $request->monday_start_time,
                    'end_time' => $request->monday_end_time
                ],
                'tuesday' => [
                    'start_time' => $request->tuesday_start_time,
                    'end_time' => $request->tuesday_end_time
                ],
                'wednesday' => [
                    'start_time' => $request->wednesday_start_time,
                    'end_time' => $request->wednesday_end_time
                ],
                'thursday' => [
                    'start_time' => $request->thursday_start_time,
                    'end_time' => $request->thursday_end_time
                ],
                'friday' => [
                    'start_time' => $request->friday_start_time,
                    'end_time' => $request->friday_end_time
                ],
                'saturday' => [
                    'start_time' => $request->saturday_start_time,
                    'end_time' => $request->saturday_end_time
                ],
                'sunday' => [
                    'start_time' => $request->sunday_start_time,
                    'end_time' => $request->sunday_end_time
                ]
            ];
            $time_schedule = json_encode($time_schedule_input);
            $this->_updateSetting('phone', $request->phone);
            $this->_updateSetting('email', $request->email);
            $this->_updateSetting('licences', $request->licences);
            $this->_updateSetting('address', $request->address);
            $this->_updateSetting('facebook', $request->facebook);
            $this->_updateSetting('tiktok', $request->tiktok);
            $this->_updateSetting('instagram', $request->instagram);
            $this->_updateSetting('whatsapp', $request->whatsapp);
            $this->_updateSetting('google_review', $request->google_review);
            $this->_updateSetting('location', $request->location);
           $this->_updateSetting('time_schedule', $time_schedule);
            return redirect('/set-list')->with('message', 'Your settings has been changed!');
        //}
        return redirect('/set-list')->with('err_message', 'Your settings has been not changed!');
    }

    private function _updateSetting($key, $value)
    {
        if($value == null){
            return;
        }
        $setting = Settings::where('key', $key)->firstOrFail();
        $setting->value = $value;
        $setting->save();

        return $setting; // Or return a success message
    }
}
