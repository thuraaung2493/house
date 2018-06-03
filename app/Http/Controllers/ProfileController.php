<?php

namespace App\Http\Controllers;

use App\House;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request)
    {
        if ($request->hasFile('image')) {
            $profile_image = $request->image;
            $image_name = str_slug(auth()->user()->name, '-');
            $extension = $profile_image->getClientOriginalExtension();
            $profile_image->storeAs('public/photos/profiles', $image_name . '.' . $extension);
            auth()->user()->profile()->create([
                'address' => $request->address,
                'phone_no' => $request->phone_no,
                'image_name' => $image_name,
                'extension' => $extension,
            ]);
        } else {
            auth()->user()->profile()->create([
                'address' => $request->address,
                'phone_no' => $request->phone_no,
            ]);
        }

        return redirect()->home();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::where('user_id', $id)->first();
        $user = User::findOrFail($id);
        $role = $user->roles()->first();
        $houses = House::where('user_id', $id)->get();
        return view('profiles.show', compact('user', 'profile', 'role', 'houses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        $user = $profile->user;
        return view('profiles.edit', compact('profile', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileUpdateRequest $request, Profile $profile)
    {
        if (Hash::check($request->password, $profile->user->password)) {
            if ($request->has('image')) {
                $profile_image = $request->image;
                $old_image_name = $profile->image_name . '.' .
                                    $profile->extension;
                $path = storage_path('app/public/photos/profiles/');
                if (File::exists($path . $old_image_name)) {
                    Storage::delete('/public/photos/profiles/' . $old_image_name);
                }
                $image_name = str_slug(auth()->user()->name, '-');
                $extension = $profile_image->getClientOriginalExtension();
                $profile_image->storeAs('public/photos/profiles', $image_name . '.' . $extension);
                $profile->update([
                    'address' => $request->address,
                    'phone_no' => $request->phone_no,
                    'image_name' => $image_name,
                    'extension' => $extension,
                ]);
            } else {
                $profile->update([
                    'address' => $request->address,
                    'phone_no' => $request->phone_no,
                ]);
            }

            alert()->success('Updated Successfully');

            return redirect()->route('profiles.show', $profile->user->id);
        }

        alert()->warning('Password is incorrect!');
        return back();
    }

    public function guest()
    {
        if (empty(auth()->user()->profile)) {
            return redirect()->route('profiles.create');
        }
        $user = auth()->user();
        // dd($user);
        return view('homes.guest-profile', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
