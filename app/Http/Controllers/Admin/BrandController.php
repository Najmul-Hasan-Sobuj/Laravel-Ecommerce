<?php

namespace App\Http\Controllers\Admin;

use Helper;
use DataTables;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Brand::get();
            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('checkbox', function ($item) {
                    return '<input  type="checkbox" name="rowId[]" id="manual_entry_' . $item->id . '" class="form-check-input" value="' . $item->id . '" />';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-inline-flex">
                                <a href="' . route('provider.brand.edit', [$row->id]) . '" class="text-primary">
                                    <i class="icon-pencil"></i>
                                </a>
                                <a href="' . route('provider.brand.destroy', [$row->id]) . '" class="text-danger delete mx-2">
                                    <i class="icon-trash"></i>
                                </a>
                                <a href="#" class="text-teal">
                                    <i class="icon-file-eye"></i>
                                </a>
                            </div>';
                    return $btn;
                })
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        }
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
        // dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'brand_name' => 'required|max:30',
                'photos.*'   => 'required|image|mimes:png,jpg,jpeg|max:5000',
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
            $imgPath = storage_path('app/public/');
            $image_names = [];
            foreach ($mainFiles as $mainFile) {
                $globalFunImg =  Helper::multipleImageUpload($mainFile, $imgPath, 230, 227);
                if ($globalFunImg['status'] == 1) {
                    $image_names[] = $globalFunImg['file_name'];
                } else {
                    Toastr::warning("upload failed");
                    return redirect()->back();
                }
            }
            Brand::create([
                'brand_name' => $request->brand_name,
                'brand_slug' => Str::slug($request->brand_name, '-'),
                'brand_logo' => $image_names,
            ]);
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
        $data['brand'] = Brand::find($id);
        return view('admin.brand.update', $data);
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
        $brand = Brand::find($id);
        if (!empty($brand)) {
            $validator =
                [
                    [
                        'brand_name' => 'required|max        : 30',
                        'photos.*'   => 'required|image|mimes: png,jpg,jpeg|max                : 5000',
                    ],
                    [
                        'photos.*'   => [
                            'max'    => 'The image field must be smaller than 5 MB.',
                        ],
                        'image'      => 'The file must be an image.',
                        'mimes'      => 'The: attribute must be a file of type: PNG - JPEG - JPG'
                    ],
                    [
                        'brand_name' => 'Brand Name',
                        'photos.*'   => 'Image',
                    ],
                ];
        } else {
            $validator =
                [
                    [
                        'brand_name' => 'required|max: 30',
                    ],
                    [
                        'brand_name' => 'Brand Name',
                    ],
                ];
        }
        $validator = Validator::make($request->all(), $validator);

        if ($validator->passes()) {
            $mainFiles = $request->photos;
            $uploadPath = storage_path('app/public/');
            foreach ($mainFiles as $mainFile) {

                if (isset($mainFile)) {
                    $globalFunImg = Helper::multipleImageUpload($mainFile, $uploadPath, 230, 227);
                } else {
                    $globalFunImg['status'] = 0;
                }

                if (!empty($brand)) {
                    if ($globalFunImg['status'] == 1) {
                        File::delete(public_path($uploadPath . '/') . $brand->photos);
                        File::delete(public_path($uploadPath . '/thumb/') . $brand->photos);
                        File::delete(public_path($uploadPath . '/requestImg/') . $brand->photos);
                    }

                    $brand->update([
                        'brand_name' => $request->brand_name,
                        'brand_logo' => $globalFunImg['status'] == 1 ? $globalFunImg['file_name'] : $brand->photos,
                    ]);
                }
            }

            Toastr::success('Data has been updated');
        } else {
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                Toastr::error($message, 'Failed', ['timeOut' => 30000]);
            }
        }
        return redirect()->back();









        $verb_id = $request->verb_id;

        $predata = Brand::findorfail($id);
        if ($predata != null) {
            $arraydata = json_decode($predata->verb_id);
            if ($request->uncheck == 1 && in_array($verb_id, $arraydata)) {

                $removedata = array_search($verb_id, $arraydata);
                unset($arraydata[$removedata]);

                $final = array_values($arraydata);
                $finaldata = json_encode($final);
                // dd($finaldata);
                Brand::valid()->find($predata->id)->update(['verb_id' => $finaldata]);
            }
            if ($request->uncheck != 1 && !in_array($verb_id, $arraydata)) {
                array_push($arraydata, $verb_id);
                $finaldata = json_encode($arraydata);
                Brand::valid()->find($predata->id)->update(['verb_id' => $finaldata]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);

        if (File::exists(public_path('storage/') . $brand->brand_logo)) {
            File::delete(public_path('storage/') . $brand->brand_logo);
        }
        if (File::exists(public_path('storage/requestImg/') . $brand->brand_logo)) {
            File::delete(public_path('storage/requestImg/') . $brand->brand_logo);
        }
        if (File::exists(public_path('storage/thumb/') . $brand->brand_logo)) {
            File::delete(public_path('storage/thumb/') . $brand->brand_logo);
        }
        $brand->delete();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function multiDelete(Request $request)
    {
        $rowIds = $request->rowIds;
        $brandMultiDelete = Brand::whereIn('id', $rowIds);
        $selectedBrands = $brandMultiDelete->get();

        foreach ($selectedBrands as $brand) {
            if (File::exists(public_path('storage/') . $brand->brand_logo)) {
                File::delete(public_path('storage/') . $brand->brand_logo);
            }
            if (File::exists(public_path('storage/requestImg/') . $brand->brand_logo)) {
                File::delete(public_path('storage/requestImg/') . $brand->brand_logo);
            }
            if (File::exists(public_path('storage/thumb/') . $brand->brand_logo)) {
                File::delete(public_path('storage/thumb/') . $brand->brand_logo);
            }
        }
        $brandMultiDelete->delete();
        return response()->json("Selected Brand(s) deleted successfully.", 200);
    }
}


// brand_logos
/**
 * id
 * brand_id
 * brand_logo_name
 */
