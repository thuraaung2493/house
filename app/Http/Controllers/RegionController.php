<?php

namespace App\Http\Controllers;

use App\House;
use App\Http\Controllers\Controller;
use App\Region;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('regions.index');
    }

    public function getData()
    {
        $regions = Region::all();

        return Datatables::of($regions)
            ->editColumn('created_at', function ($region) {
                return $region->created_at ? with(new Carbon($region->created_at))->format('m/d/Y') : '';
            })
            ->addColumn('edit', function($region) {
                return '<a href="' . route('regions.edit', $region->id) . '" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->addColumn('delete', function($region) {
                return '<form action="' . route('regions.destroy', $region->id) . '" method="POST" onsubmit="return remove()">' . csrf_field() . method_field("DELETE") . ' <button class="btn btn-sm btn-danger" type="submit"><i class="glyphicon glyphicon-remove"></i> Delete</button></form>';
            })
            ->rawColumns(['edit','delete'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('regions.create');
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
            'name' => 'required|string',
        ]);

        Region::create([
            'name' => $request->name,
        ]);

        alert()->success('New region was created', 'Successfully');

        return redirect()->route('regions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        return view('regions.show', compact('region'));
    }

    public function regionData(Region $region)
    {

        $house_ids = $region->locations()->pluck('house_id');
        // dd($locations);
        if (isAdminOrSuperadmin()) {
            $houses = House::whereIn('id', $house_ids)->get();
        } else {
            $houses = House::whereIn('id', $house_ids)
                    ->where('user_id', auth()->id())->get();
        }

        return Datatables::of($houses)
            ->editColumn('created_at', function ($house) {
                return $house->created_at ? with(new Carbon($house->created_at))->format('m/d/Y') : '';
            })
            ->addColumn('action', function($house) {
                return '<a href="' . route('admin-houses.edit', $house->id) . '" class="btn btn-sm btn-info mb-1"><i class="glyphicon glyphicon-edit"></i> Edit</a>' . '<form action="' . route('admin-houses.delete', $house->id) . '" method="POST" onsubmit="return remove()">' . csrf_field() . method_field("DELETE") . ' <button class="btn btn-sm btn-danger" type="submit"><i class="glyphicon glyphicon-remove"></i> Delete</button></form>';
            })
            ->addColumn('detail', function($house) {
                return '<a href="' . route('admin-houses.show', $house->id) . '" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-option-horizontal"></i></a>';
            })
            ->rawColumns(['action', 'detail'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        return view('regions.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $region->update([
            'name' => $request->name,
        ]);

        alert()->success('Update Successfully');

        return redirect()->route('regions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        $region->delete();

        return redirect()->route('regions.index');
    }
}
