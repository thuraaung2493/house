<?php

namespace App\Http\Controllers;

use App\ContactMessage;
use App\User;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('homes.contact-us');
    }

    public function store()
    {

        $status = User::where('email', request('host_email'))->doesntExist();
        // dd($status);
        if ($status) {
            alert()->warning('Your email ' . request('host_email') . ' is not Register!');
            return back();
        }

        $user = User::where('email', request('host_email'))->first();
        // dd($user->contactMessages());
        $user->contactMessages()->create([
            'host_name' => request('host_name'),
            'host_email' => request('host_email'),
            'host_phone' => request('host_phone'),
            'host_message' => request('host_message'),
        ]);

        alert()->success('Our admin team was received your message. As soon as you will see reply message, you can post to our site.', 'Successfully')->persistent('Close');

        return redirect()->home();
    }
}
