<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CreatePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Page::get();
            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('checkbox', function ($item) {
                    return '<input  type="checkbox" name="rowId[]" id="manual_entry_' . $item->id . '" class="form-check-input" value="' . $item->id . '" />';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-inline-flex">
                                <a href="' . route('provider.pages.edit', [$row->id]) . '" class="text-primary">
                                    <i class="icon-pencil"></i>
                                </a>
                                <a href="' . route('provider.pages.destroy', [$row->id]) . '" class="text-danger delete mx-2">
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
        return view('admin.pages.list');
        if ($request->ajax()) {
            $data = Page::get();
            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('checkbox', function ($item) {
                    return '<input  type="checkbox" name="rowId[]" id="manual_entry_' . $item->id . '" class="form-check-input" value="' . $item->id . '" />';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-inline-flex">
                                <a href="' . route('provider.page.edit', [$row->id]) . '" class="text-primary">
                                    <i class="icon-pencil"></i>
                                </a>
                                <a href="' . route('provider.page.destroy', [$row->id]) . '" class="text-danger delete mx-2">
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
        return view('admin.page.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'page_name' => 'required|max:40',
            ],
            [
                'page_name' => 'Page Name',
            ],
        );

        if ($validator->passes()) {
            Page::create([
                'page_position' => $request->page_position,
                'page_name'     => $request->page_name,
                'page_slug'     => Str::slug($request->page_title, '-'),
                'page_title'    => $request->page_title,
                'description'   => $request->description,
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
        $data['pages'] = Page::find($id);
        return view('admin.pages.update', $data);
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
        $validator = Validator::make(
            $request->all(),
            [
                'page_name' => 'required|max:40',
            ],
            [
                'page_name' => 'Page Name',
            ],
        );
        if ($validator->passes()) {
            Page::find($id)->update([
                'page_position' => $request->page_position,
                'page_name'     => $request->page_name,
                'page_slug'     => Str::slug($request->page_title, '-'),
                'page_title'    => $request->page_title,
                'description'   => $request->description,
            ]);
            Toastr::success('Page has been updated');
        } else {
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                Toastr::error($message, 'Failed', ['timeOut' => 30000]);
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
        Page::find($id)->delete();
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
        Page::whereIn('id', $rowIds)->delete();

        return response()->json("Selected Page(s) deleted successfully.", 200);
    }
}
