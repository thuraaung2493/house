<?php

namespace App\Http\Controllers;

use App\Filters\HouseFilters;
use App\Filters\LocationFilters;
use App\House;
use App\Http\Requests\SearchRequest;
use App\Location;
use App\Region;

class SearchController extends Controller
{
    public function search(SearchRequest $request, LocationFilters $locationFilters, HouseFilters $houseFilters)
    {
        $location = Location::filter($locationFilters)->get();

        $results = $location->load(['house' => function ($query) use ($houseFilters) {
            $houseFilters->apply($query)->where('is_approved', 1);
        }]);
        // dd($results);
        $numOfHouses = 0;
        foreach ($results as $result) {
            if ($result->house != null) {
                $numOfHouses++;
            }
        }

        if ($results->count() == 0 || $numOfHouses == 0) {
            alert()->warning("No Result Found", "Try again");
            return back();
        }

        alert()->success(($numOfHouses == 1) ? "$numOfHouses Result Found" : "$numOfHouses Results Found");

        return view('homes.results', compact('results', 'numOfHouses'));
    }
}
