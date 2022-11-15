<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Smtp;
use Brian2694\Toastr\Facades\Toastr;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function accountSetting()
    {
        $data['seo'] = Seo::first();
        $data['smtp'] = Smtp::first();
        // dd($data['seo']);
        return view('admin.allSetting.setting', $data);
    }

    public function seoUpdate(Request $request)
    {
        // $input = $request->all();
        DB::beginTransaction();
        $seo = Seo::first();
        if (!empty($seo)) {
            $seo->update([
                'meta_title'          => $request->meta_title,
                'meta_author'         => $request->meta_author,
                'meta_tag'            => $request->meta_tag,
                'meta_description'    => $request->meta_description,
                'google_verification' => $request->google_verification,
                'google_analytics'    => $request->google_analytics,
                'alexa_verification'  => $request->alexa_verification,
                'google_adsense_'     => $request->google_adsense_,
            ]);
            Toastr::success('Data has been Updated');
        } else {
            Seo::create([
                'meta_title'          => $request->meta_title,
                'meta_author'         => $request->meta_author,
                'meta_tag'            => $request->meta_tag,
                'meta_description'    => $request->meta_description,
                'google_verification' => $request->google_verification,
                'google_analytics'    => $request->google_analytics,
                'alexa_verification'  => $request->alexa_verification,
                'google_adsense_'     => $request->google_adsense_,
            ]);
            Toastr::success('Data has been created');
        }
        DB::commit();
        return redirect()->back();
    }

    public function smtpUpdate(Request $request)
    {
        // $input = $request->all();
        DB::beginTransaction();
        $smtp = Smtp::first();
        if (!empty($smtp)) {
            $smtp->update([
                'mailer'    => $request->mailer,
                'host'      => $request->host,
                'port'      => $request->port,
                'user_name' => $request->user_name,
                'password'  => $request->password,
            ]);
            Toastr::success('Data has been Updated');
        } else {
            Smtp::create([
                'mailer'    => $request->mailer,
                'host'      => $request->host,
                'port'      => $request->port,
                'user_name' => $request->user_name,
                'password'  => $request->password,
            ]);
            Toastr::success('Data has been created');
        }
        DB::commit();
        return redirect()->back();
    }
}
