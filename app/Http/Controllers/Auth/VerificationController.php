<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\VerificationToken;
use App\User;
use Auth;

use App\Events\UserRequestedVerificationEmail;

class VerificationController extends Controller
{
    public function verify(VerificationToken $token)
    {
        // dd($token->user);
        $token->user()->update([
            'verified' => true
        ]);

        $token->delete();

        //Auth::login($token->user);

        return redirect('/login')->withInfo('Email verification succesful. Please login again');
    }

    public function resend(Request $request)
    {
        $user = User::byEmail($request->email)->firstOrFail();

        if($user->hasVerifiedEmail()) {
            return redirect('/home')->withInfo('Your email has already been verified');
        }

        event(new UserRequestedVerificationEmail($user));

        return redirect('/login')->withInfo('Verification email resent. Please check your inbox');
    }
}
