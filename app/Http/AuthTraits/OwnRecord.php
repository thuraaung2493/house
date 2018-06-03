<?php

namespace App\Http\AuthTraits;

use Illuminate\Support\Facades\Auth;

trait OwnRecord
{
    public function userNotOwnerOf($modelRecord)
    {
        return $modelRecord->user_id != Auth::id();
    }

    public function currentUserOwns($modelRecord)
    {
        return $modelRecord->user_id === Auth::id();
    }

    public function adminOrCurrentUserOwns($modelRecord)
    {
        if (auth()->user()->inRole('admin')) {
            return true;
        }

        return $modelRecord->user_id === Auth::id();
    }
}
