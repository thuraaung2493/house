<?php

namespace App\Http\Controllers\Admin;

use App\ContactMessage;
use App\GuestMessage;
use App\House;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        if (empty(auth()->user()->profile)) {
            return redirect()->route('profiles.create');
        }

        $numOfHouses = House::all()->count();
        $numOfUsers = User::all()->count();

        $host = Role::where('slug', 'host')->first();
        $numOfHosts = $host->users->count();

        $guest = Role::where('slug', 'guest')->first();
        $numOfVistor = $guest->users->count();

        return view('backend.admin-dashboard', compact('numOfHouses', 'numOfUsers', 'numOfHosts', 'numOfVistor', 'messages'));
    }
}
