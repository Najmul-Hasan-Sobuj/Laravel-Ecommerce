<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PickUpPoint;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PickUpPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PickUpPoint::get();
            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('checkbox', function ($item) {
                    return '<input  type="checkbox" name="rowId[]" id="manual_entry_' . $item->id . '" class="form-check-input" value="' . $item->id . '" />';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-inline-flex">
                                <a href="' . route('provider.pickUpPoint.edit', [$row->id]) . '" class="text-primary">
                                    <i class="icon-pencil"></i>
                                </a>
                                <a href="' . route('provider.pickUpPoint.destroy', [$row->id]) . '" class="text-danger delete mx-2">
                                    <i class="icon-trash"></i>
                                </a>
                                <a href="#" class="text-teal">
                                    <i class="icon-file-eye"></i>
                                </a>
                            </div>';
                    return $btn;
                })
                ->rawColumns(['action', 'checkbox'])
                // ->parameters(['buttons' => ['excel']])
                ->make(true);
        }
        return view('admin.pickUpPoint.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pickUpPoint.create');
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
            'name'      => 'required|string|max: 40',
            'address'   => 'required|string|max: 150',
            'phone_one' => 'required',
        ]);

        if ($validator->passes()) {
            PickUpPoint::create([
                'name'      => $request->name,
                'address'   => $request->address,
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
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
        $data['pickUpPoint'] = PickUpPoint::find($id);
        return view('admin.pickUpPoint.update', $data);
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
            'name'      => 'required|string|max: 40',
            'address'   => 'required|string|max: 150',
            'phone_one' => 'required',

        ]);
        if ($validator->passes()) {
            PickUpPoint::find($id)->update([
                'name'      => $request->name,
                'address'   => $request->address,
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
            ]);
            Toastr::success('PickUpPoint has been updated');
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
        PickUpPoint::find($id)->delete();
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
        PickUpPoint::whereIn('id', $rowIds)->delete();

        return response()->json("Selected PickUpPoint(s) deleted successfully.", 200);
    }
}
