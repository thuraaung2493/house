<?php

namespace App\Http\Controllers;

use App\Favourite;
use App\Gallery;
use App\House;
use App\HouseFeature;
use App\HouseType;
use App\Http\Requests\HouseRequest;
use App\Http\Requests\HouseUpdateFormRequest;
use App\Location;
use App\Region;
use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class HouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'region', 'township']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recent_houses = House::newHouses()->get();
        $featured_house = House::featuredHouse()->first();
        $featured_houses = House::featuredHouse()->get();

        $apartment_id = HouseType::where('type_name', 'Apartments')
                                  ->pluck('id');
        $apartments = House::apartments($apartment_id)->get();

        $countOfYangon = $this->countOfRegion('Yangon');
        $countOfMandalay = $this->countOfRegion('Mandalay');
        $countOfNayPyiTaw = $this->countOfRegion('Nay Pyi Taw');
        $countOfPyiOoLwin = $this->countOfRegion('Pyi Oo Lwin');

        $yangonRegionId = $this->getHouseRegionId('Yangon');
        $mandalayRegionId = $this->getHouseRegionId('Mandalay');
        $naypyitawRegionId = $this->getHouseRegionId('Nay Pyi Taw');
        $pyioolwinRegionId = $this->getHouseRegionId('Pyi Oo Lwin');
        // dd($yangonRegionId);
        return view('homes.home.index', compact('recent_houses',
            'featured_house', 'featured_houses', 'apartments', 'countOfYangon',
            'countOfMandalay', 'countOfNayPyiTaw', 'countOfPyiOoLwin',
            'yangonRegionId', 'mandalayRegionId', 'naypyitawRegionId',
            'pyioolwinRegionId'));
    }

    public function countOfRegion($region_name)
    {
        $region_id = $this->getHouseRegionId($region_name);

        $locations = Location::with(['house' => function ($query) {
            $query->where('is_approved', 1);
        }])->where('region_id', $region_id)->get();

        $count = 0;

        foreach ($locations as $location) {
            if (!empty($location->house)) {
                $count++;
            }
        }
        return $count;
    }

    public function getHouseRegionId($region_name)
    {
        return Region::where('name', $region_name)
                                 ->pluck('id');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->adminOrHost()) {
            if (empty(auth()->user()->profile)) {
                return redirect()->route('profiles.create');
            }
            $features = HouseFeature::all();

            return view('homes.create', compact('features'));
        }

        alert()->warning('If you want to be a host, you should send message to our admin teams.', 'Not Allow!');

        return view('homes.contact-us');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HouseRequest $request)
    {
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

        return redirect()->route('houses.show', compact('house_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function show(House $house)
    {
        // $house = $house->load(['houseDetail', 'houseType', 'location']);

        $all_features = HouseFeature::all();
        $features = explode(', ', $house->features);

        $images = $house->galleries;

        // reviews
        $reviews = $house->reviews;

        // related houses
        $related_township = $house->location->township;
        $related_houses = House::with(['location' => function ($query) use ($related_township) {
            $query->where('township', $related_township);
        }])->where('is_approved', 1)->where('id', '!=', $house->id)->get();


        return view('homes.show', compact('house', 'images', 'all_features', 'features', 'reviews', 'related_houses'));
    }

    public function region(Region $region)
    {
        $houses = House::with(['location' => function ($query) use ($region) {
            $query->where('region_id', $region->id);
        }])->where('is_approved', 1)->get();

        return view('homes.regions', compact('houses', 'region'));
    }

    public function township($township)
    {
        $houses = House::with(['location' => function ($query) use ($township) {
            $query->where('township', $township);
        }])->where('is_approved', 1)->get();

        return view('homes.townships', compact('houses', 'township'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function edit(House $house)
    {
        // dd($house);
        // $house_type_id = $house->HouseType->id;
        // $houseDetail = $house->houseDetail;
        // $location = $house->location;
        $features = HouseFeature::all();
        $house_features = explode(', ', $house->features);

        $images = Gallery::where('house_id', $house->id)->where('is_featured', 0)->get();

        return view('homes.edit', compact('house', 'features', 'house_features', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function update(HouseUpdateFormRequest $request, House $house)
    {
        $features = implode(', ', $request->features);
        //house basic
        $house->update([
            'title' => $request->title,
            'house_type_id' => $request->house_type_id,
            'house_detail_id' => $house->houseDetail->id,
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

        return redirect()->route('houses.show', compact('house_id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function destroy(House $house)
    {
        //
    }
}
