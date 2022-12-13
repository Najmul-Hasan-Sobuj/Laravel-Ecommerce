<?php

namespace App\Http\Controllers\Admin;

use Helper;
use DataTables;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\ChildCategory;
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

    public function subCategoryProductDropdown(Request $request)
    {
        $category_id = $request->category_id;
        $data['subCategories'] = SubCategory::where('category_id', $category_id)->get();
        return view('admin.subCategory.subCategoryOption', $data);
    }

    public function childCategoryProductDropdown(Request $request)
    {
        $sub_category_id = $request->sub_category_id;
        $data['childCategories'] = ChildCategory::where('sub_category_id', $sub_category_id)->get();
        return view('admin.subCategory.childCategoryOption', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categorys'] = Category::select('categories.id', 'categories.category_name')->get();
        $data['brands'] = Brand::select('brands.id', 'brands.brand_name')->get();
        return view('admin.product.create', $data);
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
