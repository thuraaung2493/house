<?php

namespace App\Http\Controllers;

use App\HouseFeature;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('features.index');
    }

    public function getData()
    {
        $features = HouseFeature::all();

        return Datatables::of($features)
            ->editColumn('created_at', function ($feature) {
                return $feature->created_at ? with(new Carbon($feature->created_at))->format('m/d/Y') : '';
            })
            ->addColumn('edit', function($feature) {
                return '<a href="' . route('features.edit', $feature->id) . '" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->addColumn('delete', function($feature) {
                return '<form action="' . route('features.destroy', $feature->id) . '" method="POST" onsubmit="return remove()">' . csrf_field() . method_field("DELETE") . ' <button class="btn btn-sm btn-danger" type="submit"><i class="glyphicon glyphicon-remove"></i> Delete</button></form>';
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
        return view('features.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string']);

        HouseFeature::create(['name' => strtolower($request->name)]);

        alert()->success('A new feature was created', 'Successfully');

        return redirect()->route('features.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(HouseFeature $feature)
    {
        return view('features.edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HouseFeature $feature)
    {
        $request->validate(['name' => 'required|string']);

        $feature->update(['name' => strtolower($request->name)]);

        alert()->success('Updated Successfully');

        return redirect()->route('features.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(HouseFeature $feature)
    {
        $feature->delete();

        return back();
    }
}
