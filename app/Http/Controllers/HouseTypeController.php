<?php

namespace App\Http\Controllers;

use App\HouseType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class HouseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('types.index');
    }

    public function getData()
    {
        $types = HouseType::all();
        // dd($types);
        return Datatables::of($types)
            ->editColumn('created_at', function ($type) {
                return $type->created_at ? with(new Carbon($type->created_at))->format('m/d/Y') : '';
            })
            ->addColumn('edit', function($type) {
                return '<a href="' . route('types.edit', $type->id) . '" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->addColumn('delete', function($type) {
                return '<form action="' . route('types.destroy', $type->id) . '" method="POST" onsubmit="return remove()">' . csrf_field() . method_field("DELETE") . ' <button class="btn btn-sm btn-danger" type="submit"><i class="glyphicon glyphicon-remove"></i> Delete</button></form>';
            })
            ->rawColumns(['edit', 'delete'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'required|string',
        ]);

        HouseType::create(['type_name' => title_case($request->type_name)]);

        alert()->success('A new type was created', 'Successfully');

        return redirect()->route('types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(HouseType $type)
    {
        return view('types.show', compact('type'));
    }

    public function typeData(HouseType $type)
    {
        if (isAdminOrSuperadmin()) {
            $houses = $type->houses;
        } else {
            $houses = $type->houses()->where('user_id', auth()->id())->get();
        }

        return Datatables::of($houses)
            ->editColumn('created_at', function ($house) {
                return $house->created_at ? with(new Carbon($house->created_at))->format('m/d/Y') : '';
            })
            ->addColumn('feature', function($house) {
                if ($house->isFeatured()) {
                    return '<a href="' . route('houses.unfeature', $house->id) . '" class="btn btn-sm btn-primary"><i class="fa fa-ban"></i> Unfeatured</a>';
                }
                return '<a href="' . route('houses.feature', $house->id) . '" class="btn btn-sm btn-primary"><i class="fa fa-star"></i> Featured</a>';
            })
            ->addColumn('action', function($house) {
                return '<a href="' . route('admin-houses.edit', $house->id) . '" class="btn btn-sm btn-info mb-1"><i class="glyphicon glyphicon-edit"></i> Edit</a>' . '<form action="' . route('admin-houses.delete', $house->id) . '" method="POST" onsubmit="return remove()">' . csrf_field() . method_field("DELETE") . ' <button class="btn btn-sm btn-danger" type="submit"><i class="glyphicon glyphicon-remove"></i> Delete</button></form>';
            })
            ->addColumn('detail', function($house) {
                return '<a href="' . route('admin-houses.show', $house->id) . '" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-option-horizontal"></i></a>';
            })
            ->rawColumns(['feature', 'action', 'detail'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(HouseType $type)
    {
        return view('types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HouseType $type)
    {
        $request->validate(['type_name' => 'required|string']);

        $type->update(['type_name' => title_case($request->type_name)]);

        alert()->success('Updated Successfully');

        return redirect()->route('types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(HouseType $type)
    {
        $type->delete();

        alert()->success('Deleted Successfully');

        return redirect()->route('types.index');
    }
}
