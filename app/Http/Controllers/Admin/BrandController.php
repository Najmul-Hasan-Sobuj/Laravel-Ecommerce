<?php

namespace App\Http\Controllers\Admin;

use Helper;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.brand.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        Helper::imageDirectory();

        $validator = Validator::make(
            $request->all(),
            [
                'brand_name' => 'required|max:30',
                'photos.*'   => 'required|image|mimes:png,jpg,jpeg|max:5000', //dimensions:min_width=250,min_height=500
            ],
            [
                'required' => 'The: attribute field is mandatory.',
                'photos.*' => [
                    'max'      => 'The image field must be smaller than 5 MB.',
                ],
                'image'    => 'The file must be an image.',
                'mimes' => 'The :attribute must be a file of type: PNG - JPEG - JPG'
            ],
            [
                'brand_name' => 'Brand Name',
                'photos.*'   => 'Image',
            ],
        );

        if ($validator->passes()) {
            $mainFiles = $request->file('photos');
            $imgPath = 'public/';
            if (empty($mainFiles)) {
                Brand::create([
                    'brand_name' => $request->brand_name,
                    'brand_slug' => Str::slug($request->brand_name, '-'),
                ]);
            } else {
                foreach ($mainFiles as $mainFile) {
                    $globalFunImg =  Helper::imageUploadsFunction($mainFile, $imgPath, 230, 227);
                    if ($globalFunImg['status'] == 1) {
                        Brand::create([
                            'brand_name' => $request->brand_name,
                            'brand_slug' => Str::slug($request->brand_name, '-'),
                            'brand_logo' => $globalFunImg['file_name'],
                        ]);
                    } else {
                        $output['messege'] = $globalFunImg['errors'];
                        Toastr::warning($output['messege']);
                        return redirect()->back();
                    }
                }
            }
            Toastr::success('Data Inserted Successfully');
        } else {
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                Toastr::error($message, 'Failed', ['timeOut' => 30000]);
            }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
