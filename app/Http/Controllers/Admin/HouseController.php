<?php

namespace App\Http\Controllers\Admin;

use App\House;
use App\Region;
use App\Gallery;
use App\HouseType;
use App\HouseFeature;
use App\Http\Controllers\Controller;
use App\Http\Requests\HouseRequest;
use App\Http\Requests\HouseUpdateFormRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Yajra\Datatables\Datatables;

class HouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('backend.houses.house-all');
    }

    public function getData()
    {
        $houses = House::all();

        return Datatables::of($houses)
            ->editColumn('created_at', function ($house) {
                return $house->created_at ? with(new Carbon($house->created_at))->format('m/d/Y') : '';
            })
            ->addColumn('feature', function($house) {
                if ($house->isFeatured()) {
                    if (auth()->user()->hasAccess(['unfeature-house'])) {
                        return '<a href="' . route('houses.unfeature', $house->id) . '" class="btn btn-sm btn-warning"><i class="fa fa-ban"></i> Unfeatured</a>';
                    }
                }
                if (auth()->user()->hasAccess(['feature-house'])) {
                    return '<a href="' . route('houses.feature', $house->id) . '" class="btn btn-sm btn-primary"><i class="fa fa-star"></i> Featured</a>';
                }
            })
            ->addColumn('action', function($house) {
                if (auth()->user()->hasAccess(['update-house', 'delete-house'])) {
                    return '<a href="' . route('admin-houses.edit', $house->id) . '" class="btn btn-sm btn-info mb-1"><i class="glyphicon glyphicon-edit"></i> Edit</a>' . '<form action="' . route('admin-houses.delete', $house->id) . '" method="POST" onsubmit="return remove()">' . csrf_field() . method_field("DELETE") . ' <button class="btn btn-sm btn-danger" type="submit"><i class="glyphicon glyphicon-remove"></i> Delete</button></form>';
                }
            })
            ->addColumn('detail', function($house) {
                return '<a href="' . route('admin-houses.show', $house->id) . '" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-option-horizontal"></i></a>';
            })
            ->rawColumns(['feature', 'action', 'detail'])
            ->make(true);
    }

    public function featureHouse()
    {
        return view('backend.houses.feature');
    }

    public function featureData()
    {
        $houses = House::where('featured_house', 1)->get();

        return Datatables::of($houses)
            ->editColumn('created_at', function ($house) {
                return $house->created_at ? with(new Carbon($house->created_at))->format('m/d/Y') : '';
            })
            ->addColumn('unfeature', function($house) {
                if (auth()->user()->hasAccess(['unfeature-house'])) {
                    return '<a href="' . route('houses.unfeature', $house->id) . '" class="btn btn-sm btn-warning"><i class="fa fa-ban"></i> Unfeatured</a>';
                }
            })
            ->addColumn('action', function($house) {
                if (auth()->user()->hasAccess(['update-house', 'delete-house'])) {
                    return '<a href="' . route('admin-houses.edit', $house->id) . '" class="btn btn-sm btn-info mb-1"><i class="glyphicon glyphicon-edit"></i> Edit</a>' . '<form action="' . route('admin-houses.delete', $house->id) . '" method="POST" onsubmit="return remove()">' . csrf_field() . method_field("DELETE") . ' <button class="btn btn-sm btn-danger" type="submit"><i class="glyphicon glyphicon-remove"></i> Delete</button></form>';
                }
            })
            ->addColumn('detail', function($house) {
                return '<a href="' . route('admin-houses.show', $house->id) . '" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-option-horizontal"></i></a>';
            })
            ->rawColumns(['unfeature', 'action', 'detail'])
            ->make(true);
    }

    public function unpublish()
    {
        return view('backend.houses.house-unpublish');
    }

    public function unpublishData()
    {
        $houses = House::where('is_approved', 0)->get();

        return Datatables::of($houses)
            ->editColumn('created_at', function ($house) {
                return $house->created_at ? with(new Carbon($house->created_at))->format('m/d/Y') : '';
            })
            ->addColumn('publish', function($house) {
                if (auth()->user()->hasAccess(['approve-house'])) {
                    return '<a href="' . route('houses.approve', $house->id) . '" class="btn btn-sm btn-primary">Publish</a>';
                }
            })
            ->addColumn('action', function($house) {
                if (auth()->user()->hasAccess(['update-house', 'delete-house'])) {
                    return '<a href="' . route('admin-houses.edit', $house->id) . '" class="btn btn-sm btn-info mb-1"><i class="glyphicon glyphicon-edit"></i> Edit</a>' . '<form action="' . route('admin-houses.delete', $house->id) . '" method="POST" onsubmit="return remove()">' . csrf_field() . method_field("DELETE") . ' <button class="btn btn-sm btn-danger" type="submit"><i class="glyphicon glyphicon-remove"></i> Delete</button></form>';
                }
            })
            ->addColumn('detail', function($house) {
                return '<a href="' . route('admin-houses.show', $house->id) . '" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-option-horizontal"></i></a>';
            })
            ->rawColumns(['publish', 'action', 'detail'])
            ->make(true);
    }

    public function publish()
    {
        return view('backend.houses.house-publish');
    }

    public function publishData()
    {
        $houses = House::where('is_approved', 1)->get();

        return Datatables::of($houses)
            ->editColumn('created_at', function ($house) {
                return $house->created_at ? with(new Carbon($house->created_at))->format('m/d/Y') : '';
            })
            ->addColumn('unpublish', function($house) {
                if (auth()->user()->hasAccess(['block-house'])) {
                    return '<a href="' . route('houses.block', $house->id) . '" class="btn btn-sm btn-warning">Unpublish</a>';
                }
            })
            ->addColumn('action', function($house) {
                if (auth()->user()->hasAccess(['update-house', 'delete-house'])) {
                    return '<a href="' . route('admin-houses.edit', $house->id) . '" class="btn btn-sm btn-info mb-1"><i class="glyphicon glyphicon-edit"></i> Edit</a>' . '<form action="' . route('admin-houses.delete', $house->id) . '" method="POST" onsubmit="return remove()">' . csrf_field() . method_field("DELETE") . ' <button class="btn btn-sm btn-danger" type="submit"><i class="glyphicon glyphicon-remove"></i> Delete</button></form>';
                }
            })
            ->addColumn('detail', function($house) {
                return '<a href="' . route('admin-houses.show', $house->id) . '" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-option-horizontal"></i></a>';
            })
            ->rawColumns(['unpublish', 'action', 'detail'])
            ->make(true);
    }

    public function approve(House $house)
    {
        $house->is_approved = true;
        $house->save();
        return redirect()->route('houses.unpublish');
    }

    public function approveAll()
    {
        House::where('is_approved', 0)->update(['is_approved' => 1]);

        return back();
    }

    public function block(House $house)
    {
        $house->is_approved = false;
        $house->save();
        return redirect()->route('houses.publish');
    }

    public function blockAll()
    {
        House::where('is_approved', 1)->update(['is_approved' => 0]);

        return back();
    }

    public function feature(House $house)
    {
        $house->featured_house = true;
        $house->save();
        return back();
    }

    public function unfeature(House $house)
    {
        $house->featured_house = false;
        $house->save();
        return back();
    }

    public function create()
    {
        $types = HouseType::all();
        $regions = Region::all();
        $all_features = HouseFeature::all();

        return view('backend.houses.create', compact('types', 'regions', 'all_features'));
    }

    public function store(HouseRequest $request)
    {
        // dd($request->all());
        //house basic
        $features = implode(', ', $request->features);
        $house = House::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'house_type_id' => $request->house_type_id,
            'period' => $request->period,
            'price' => $request->price,
            'area' => $request->area,
            'rooms' => $request->rooms,
            'description' => $request->description,
            'features' => $features,
        ]);

        $house_id = $house->id;

        //house details
        $house->houseDetail()->create([
            'building_year' => $request->building_year,
            'bathrooms' => $request->bathrooms,
            'bedrooms' => $request->bedrooms,
            'parking' => $request->parking,
            'water' => $request->water,
            'exercise_room' => $request->exercise_room,
        ]);

        //featured image
        $feature_image = $request->feature_image;
        $feature_extension = $feature_image->getClientOriginalExtension();
        $feature_image_name = $house_id . '-feature-image';
        // store image in storage/public/photos
        $feature_image->storeAs('public/photos/',
                                $feature_image_name . '.'
                                . $feature_extension);

        $thumb_featured_img = Image::make($feature_image->getRealPath());
        $thumb_featured_img->resize(100,100)
                           ->save(storage_path('app/public/photos/thumbnails/'
                            . $feature_image_name . '.' . $feature_extension));

         // save to database (galleries)
        $house->galleries()->create([
            'image_name' => $feature_image_name,
            'extension' => $feature_extension,
            'is_featured' => true,
        ]);

        // other images
        $images = $request->images;
        foreach ($images as $index => $image) {
            $image_extension = $image->getClientOriginalExtension();
            $image_name = $house_id . '-house-image' . $index;
            $image->storeAs('public/photos',
                            $image_name . '.' . $image_extension);

            $thumb_img = Image::make($image->getRealPath());
            $thumb_img->resize(100,100)
                      ->save(storage_path('app/public/photos/thumbnails/'
                        . $image_name . '.' . $image_extension));

            $house->galleries()->create([
                'image_name' => $image_name,
                'extension' => $image_extension,
            ]);
        }

        //locations
        $house->location()->create([
            'address' => title_case($request->address),
            'street' => title_case($request->street),
            'township' => title_case($request->township),
            'region_id' => $request->region,
        ]);

        alert()->success('Successfully', 'A New House is created successfully.');

        return redirect()->route('admin-houses.show', compact('house_id'));
    }

    public function show(House $house)
    {
        $features = explode(', ', $house->features);
        // dd($house->galleries);
        return view('backend.houses.show', compact('house', 'features'));
    }

    public function edit(House $house)
    {
        $features = explode(', ', $house->features);
        $types = HouseType::all();
        $regions = Region::all();
        $all_features = HouseFeature::all();

        return view('backend.houses.edit', compact('house', 'types', 'regions', 'features', 'all_features'));
    }

    public function update(HouseUpdateFormRequest $request, House $house)
    {
        $features = implode(', ', $request->features);
        // dd($features);
        //house basic
        $house->update([
            'title' => $request->title,
            'house_type_id' => $request->house_type_id,
            'period' => $request->period,
            'price' => $request->price,
            'area' => $request->area,
            'rooms' => $request->rooms,
            'description' => $request->description,
            'features' => $features,
        ]);

        //house details
        $house->houseDetail()->update([
            'building_year' => $request->building_year,
            'bathrooms' => $request->bathrooms,
            'bedrooms' => $request->bedrooms,
            'parking' => $request->parking,
            'water' => $request->water,
            'exercise_room' => $request->exercise_room,
        ]);

        $house_id = $house->id;

        //featured image
        if ($request->has('feature_image')) {
            // get old feature image
            $old_feature_image = Gallery::where('house_id', $house_id)->where('is_featured', 1)->first();

            // delete old feature image
            $old_feature_image->delete();
            $image_name = $old_feature_image->image_name . '.' . $old_feature_image->extension;
            $path = storage_path('app/public/photos/');
            $thumbnail_path = storage_path('app/public/photos/thumbnails/');

            if (File::exists($path . $image_name)) {
                Storage::delete('/public/photos/' . $image_name);
            }
            if (File::exists($thumbnail_path . $image_name)) {
                Storage::delete('/public/photos/thumbnails/' . $image_name);
            }

            //featured image
            $feature_image = $request->feature_image;
            $feature_extension = $feature_image->getClientOriginalExtension();
            $feature_image_name = $house_id . '-feature-image';

            $house->galleries()->create([
                'image_name' => $feature_image_name,
                'extension' => $feature_extension,
                'is_featured' => true,
            ]);

            // store image in storage/public/photos/features/
            $feature_image->storeAs('public/photos/',
                                    $feature_image_name . '.'
                                    . $feature_extension);

            $thumb_featured_img = Image::make($feature_image->getRealPath());
            $thumb_featured_img->resize(100,100)
                               ->save(storage_path('app/public/photos/thumbnails/'
                                . $feature_image_name . '.' . $feature_extension));
        }

        // other images
        if ($request->has('images')) {
            // get old images
            $old_images = Gallery::where('house_id', $house_id)->where('is_featured', 0)->get();

            // delete old images
            foreach ($old_images as $image) {
                $image->delete();
                $image_name = $image->image_name . '.' . $image->extension;
                $path = storage_path('app/public/photos/');
                $thumbnail_path = storage_path('app/public/photos/thumbnails/');
                if (File::exists($path . $image_name)) {
                    Storage::delete('/public/photos/' . $image_name);
                }
                if (File::exists($thumbnail_path . $image_name)) {
                    Storage::delete('/public/photos/thumbnails/' . $image_name);
                }
            }

            $images = $request->images;
            foreach ($images as $index => $image) {
                $image_extension = $image->getClientOriginalExtension();
                $image_name = $house_id . '-house-image' . $index;

                $house->galleries()->create([
                    'image_name' => $image_name,
                    'extension' => $image_extension,
                ]);

                $image->storeAs('public/photos',
                                $image_name . '.' . $image_extension);

                $thumb_img = Image::make($image->getRealPath());
                $thumb_img->resize(100,100)
                          ->save(storage_path('app/public/photos/thumbnails/'
                            . $image_name . '.' . $image_extension));
            }
        }

        //locations update
        $house->location()->update([
            'address' => $request->address,
            'street' => $request->street,
            'township' => $request->township,
            'region_id' => $request->region,
        ]);

        alert()->success('Updated Successfully', $house->title . ' is updated successfully.');

        return redirect()->route('admin-houses.show', compact('house_id'));
    }

    public function destroy(House $house)
    {
        // dd($house->galleries);
        $house->delete();
        $house->houseDetail()->delete();
        $house->location()->delete();

        foreach ($house->galleries as $image) {
            $image_name = $image->image_name . '.' . $image->extension;
            $path = storage_path('app/public/photos/');
            $thumbnails = storage_path('app/public/photos/thumbnails/');
            if (File::exists($path . $image_name)) {
                Storage::delete('/public/photos/' . $image_name);
            }
            if (File::exists($thumbnails . $image_name)) {
                Storage::delete('/public/photos/thumbnails/' . $image_name);
            }
        }

        $house->galleries()->delete();

        if (!empty($house->reviews)) {
            $house->reviews()->delete();
        }

        return back();
    }
}
