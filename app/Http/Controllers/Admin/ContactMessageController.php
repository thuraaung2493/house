<?php

namespace App\Http\Controllers\Admin;

use App\ContactMessage;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ContactMessageController extends Controller
{
    public function getData()
    {
        $messages = ContactMessage::all();
        return Datatables::of($messages)
            ->addColumn('confirm', function($message) {
                return '<form action="' . route('contact-messages.confirm', $message->user_id) . '" method="POST" onsubmit="return approve()">' . csrf_field() . ' <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-check"></i> Confirm</button></form>';
            })
            ->addColumn('remove', function($message) {
                return '<form action="' . route('contact-messages.delete', $message->id) . '" method="POST" onsubmit="return remove()">' . csrf_field() . method_field("DELETE") . ' <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i> Remove</button></form>';
            })
            ->addColumn('profile', function($message) {
                return '<a href="' . route('profiles.show', $message->user_id) . '" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-option-horizontal"></i></a>';
            })
            ->rawColumns(['confirm', 'remove', 'profile'])
            ->make(true);
    }

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy(ContactMessage $message)
    {
        $message->delete();

        alert()->success("Remove Message Successfully");
        return back();
    }

    public function confirm(User $user)
    {
        $user->changeRole('host');
        ContactMessage::where('user_id', $user->id)->delete();

        return back();
    }
}
