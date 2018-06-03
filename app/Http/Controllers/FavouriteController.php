<?php

namespace App\Http\Controllers;

use App\Favourite;
use App\House;
use App\User;
use Illuminate\Http\Request;
use App\Http\AuthTraits\OwnRecord;
use Illuminate\Support\Facades\Session;

class FavouriteController extends Controller
{
    use OwnRecord;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(House $house)
    {
        if ($this->currentUserOwns($house)) {
            alert()->warning("This is your house, so you can not add to favourite.", "Sorry");
            return redirect()->route('houses.show', ['id' => $house->id]);
        }

        if (Favourite::doesNotExitInFavourite($house)) {
            Favourite::create([
                'user_id' => auth()->id(),
                'favourite_house_id' => $house->id,
            ]);
        }

        return redirect()->route('favourite.show');
    }

    public function show()
    {
        $favHouseIds = Favourite::where('user_id', auth()->id())->pluck('favourite_house_id');

        $fav_houses = House::favouriteHouses($favHouseIds)->get();

        return view('homes.favourites', compact('fav_houses'));
    }

    public function delete($id)
    {
        // dd($id);
        Favourite::where('favourite_house_id', $id)->delete();

        return redirect()->route('favourite.show');
    }
}
