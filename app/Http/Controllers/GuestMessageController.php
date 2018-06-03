<?php

namespace App\Http\Controllers;

use App\GuestMessage;
use App\House;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use Illuminate\Http\Request;

class GuestMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = GuestMessage::where('user_id', auth()->id())->get();

        return view('backend.messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageRequest $request, House $house)
    {
        // dd($request->all());
        GuestMessage::create([
            'user_id' => $request->host_id,
            'house_id' => $house->id,
            'guest_name' => $request->guest_name,
            'guest_email' => $request->guest_email,
            'guest_phone' => $request->guest_phone,
            'guest_message' => $request->guest_message,
        ]);

        alert()->success('Successfully', 'Message Sent Successfully');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(GuestMessage $guest_message)
    {
        return view('backend.messages.show', compact('guest_message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(GuestMessage $guest_message)
    {
        $guest_message->delete();

        return redirect()->route('guest-messages.index');
    }
}
