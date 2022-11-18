<?php

namespace App\Http\Controllers\Admin;

use Helper;
use App\Models\Seo;
use App\Models\Smtp;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

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
        $data['webSetting'] = Setting::first();
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
        $validator = Validator::make($request->all(), [
            'port' => 'numeric',
        ]);

        DB::beginTransaction();
        $smtp = Smtp::first();

        if ($validator->passes()) {
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
        } else {
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                Toastr::error($message, 'Failed', ['timeOut' => 10000]);
            }
        }
        DB::commit();
        return redirect()->back();
    }

    public function webSettingUpdate(Request $request)
    {

        // dd($request->all());
        Helper::imageDirectory();
        $webSetting = Setting::first();
        if (!empty($webSetting)) {
            $validator =
                [
                    [
                        'currency'      => 'required|min:1|max:10',
                        'phone_one'     => 'required|numeric|digits:11|starts_with:0',
                        'main_email'    => 'required|email|max:40|regex:/(.*)@gmail\.com/|unique:settings',
                        'logo'          => 'required|image|mimes:png,jpg,jpeg|max:1000',
                        'favicon'       => 'required|image|mimes:png,jpg,jpeg|max:1000',
                    ],
                    [
                        'logo'    => [
                            'max' => 'The image field must be smaller than 1 MB.',
                        ],
                        'favicon' => [
                            'max' => 'The image field must be smaller than 1 MB.',
                        ],
                        'image' => 'The file must be an image.',
                        'mimes' => 'The: attribute must be a file of type: PNG - JPEG - JPG'
                    ],
                    [
                        'phone_one'     => 'primary phone number',
                        'main_email'    => 'primary email address',
                    ],
                ];
        } else {
            $validator =
                [
                    [
                        'currency'      => 'required|min:1|max:10',
                        'phone_one'     => 'required|numeric|digits:11|starts_with:0',
                        'main_email'    => 'required|email|max:40|regex:/(.*)@gmail\.com/|unique:settings',
                    ],
                    [
                        'phone_one'     => 'primary phone number',
                        'main_email'    => 'primary email address',
                    ],
                ];
        }
        $validator = Validator::make($request->all(), $validator);

        if ($validator->passes()) {
            // if (isset($request->logo)) {
            $logoMainFile = $request->logo;
            $faviconMainFile = $request->favicon;
            $uploadPath = 'public/';
            if (isset($logoMainFile)) {
                $globalFunImgLogo = Helper::singleImageUpload($logoMainFile, $uploadPath, 230, 227);
            } else {
                $globalFunImgLogo = ['status' => 0];
            }

            if (isset($faviconMainFile)) {
                $globalFunImgFavicon = Helper::singleImageUpload($faviconMainFile, $uploadPath, 230, 227);
            } else {
                $globalFunImgFavicon = ['status' => 0];
            }

            if (!empty($webSetting)) {
                // if ($request->logo != $webSetting->logo) {
                // }
                if ($globalFunImgLogo['status'] == 1) {
                    File::delete(public_path($uploadPath . '/') . $webSetting->logo);
                    File::delete(public_path($uploadPath . '/thumb/') . $webSetting->logo);
                    File::delete(public_path($uploadPath . '/requestImg/') . $webSetting->logo);
                }
                if ($globalFunImgFavicon['status'] == 1) {
                    File::delete(public_path($uploadPath . '/') . $webSetting->logo);
                    File::delete(public_path($uploadPath . '/thumb/') . $webSetting->logo);
                    File::delete(public_path($uploadPath . '/requestImg/') . $webSetting->logo);
                }

                $webSetting->update([
                    'currency'      => $request->currency,
                    'phone_one'     => $request->phone_one,
                    'phone_two'     => $request->phone_two,
                    'main_email'    => $request->main_email,
                    'support_email' => $request->support_email,
                    'logo'          => $globalFunImgLogo['status'] == 1 ? $globalFunImgLogo['file_name'] : $webSetting->logo,
                    'favicon'       => $globalFunImgFavicon['status'] == 1 ? $globalFunImgFavicon['file_name'] : $webSetting->favicon,
                    'address'       => $request->address,
                    'facebook'      => $request->facebook,
                    'twitter'       => $request->twitter,
                    'instagram'     => $request->instagram,
                    'linkedin'      => $request->linkedin,
                    'youtube'       => $request->youtube,
                ]);
                Toastr::success('Data has been updated');
            } else {
                Setting::create([
                    'currency'      => $request->currency,
                    'phone_one'     => $request->phone_one,
                    'phone_two'     => $request->phone_two,
                    'main_email'    => $request->main_email,
                    'support_email' => $request->support_email,
                    'logo'          => $globalFunImgLogo['status'] == 1 ? $globalFunImgLogo['file_name'] : '',
                    'favicon'       => $globalFunImgFavicon['status'] == 1 ? $globalFunImgFavicon['file_name'] : '',
                    'address'       => $request->address,
                    'facebook'      => $request->facebook,
                    'twitter'       => $request->twitter,
                    'instagram'     => $request->instagram,
                    'linkedin'      => $request->linkedin,
                    'youtube'       => $request->youtube,
                ]);
                Toastr::success('Data has been created');
            }
            // } else {
            //     $webSetting->update([
            //         'currency'      => $request->currency,
            //         'phone_one'     => $request->phone_one,
            //         'phone_two'     => $request->phone_two,
            //         'main_email'    => $request->main_email,
            //         'support_email' => $request->support_email,
            //         'address'       => $request->address,
            //         'facebook'      => $request->facebook,
            //         'twitter'       => $request->twitter,
            //         'instagram'     => $request->instagram,
            //         'linkedin'      => $request->linkedin,
            //         'youtube'       => $request->youtube,
            //     ]);
            //     Toastr::success('Data has been updated');
            // }
        } else {
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                Toastr::error($message, 'Failed', ['timeOut' => 30000]);
            }
        }
        return redirect()->back();
    }
}
