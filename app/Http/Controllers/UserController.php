<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    function getUserProfile() {
        $user = Auth::user();

        return view('user_profile', compact('user'));
    }
}
