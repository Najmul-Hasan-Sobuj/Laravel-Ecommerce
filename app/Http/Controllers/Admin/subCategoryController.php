<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class subCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SubCategory::join('categories', 'sub_categories.category_id', '=', 'categories.id')->select('sub_categories.id', 'categories.category_name', 'sub_categories.sub_category_name')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-inline-flex">
                    <a href="' . route('provider.categories.subCategory.edit', [$row->id]) . '" class="text-primary">
                    <i class="icon-pencil"></i>
                </a>
                                <a href="' . route('provider.categories.subCategory.destroy', [$row->id]) . '" class="text-danger delete mx-2">
                                <i class="icon-trash"></i>
                            </a>
                                <a href="#" class="text-teal">
                                    <i class="icon-file-eye"></i>
                                </a>
                            </div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.subCategory.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id'     => 'required',
            'sub_category_name' => 'required|max:50',
        ]);
        if ($validator->passes()) {
            SubCategory::create([
                'category_id'       => $request->category_id,
                'sub_category_name' => $request->sub_category_name,
                'sub_category_slug' => Str::slug($request->sub_category_name, '-'),
            ]);
            Toastr::success('Data Inserted Successfully');
        } else {
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                Toastr::error($message, 'Failed', ['timeOut' => 10000]);
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
        $data['categorys'] = Category::select('categories.id', 'categories.category_name')->get();
        $data['subCategory'] = SubCategory::find($id);
        return view('admin.subCategory.update', $data);
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
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|max:40',
            'sub_category_name' => 'required|max:40',

        ]);
        if ($validator->passes()) {
            SubCategory::find($id)->update([
                'category_id' => $request->category_id,
                'sub_category_name' => $request->sub_category_name,
                'sub_category_slug' => Str::slug($request->sub_category_name, '-'),
            ]);
            Toastr::success('Sub Category has been updated');
        } else {
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                Toastr::error($message, 'Failed', ['timeOut' => 10000]);
            }
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        SubCategory::find($id)->delete();
    }
}
