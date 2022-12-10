<?php

namespace App\Http\Controllers\Admin;

use Helper;
use DataTables;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $brand = Product::find($id);

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
        $brandMultiDelete = Product::whereIn('id', $rowIds);
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
