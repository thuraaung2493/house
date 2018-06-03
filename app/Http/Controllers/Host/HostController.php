<?php

namespace App\Http\Controllers\Host;

use App\GuestMessage;
use App\House;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HostController extends Controller
{
    public function index()
    {
        if (empty(auth()->user()->profile)) {
            return redirect()->route('profiles.create');
        }

        $numOfHouses = House::where('user_id', auth()->id())->count();
        $numOfGuestMessage = GuestMessage::where('user_id', auth()->id())->count();

        return view('backend.host-dashboard', compact('numOfHouses', 'numOfGuestMessage'));
    }
}
