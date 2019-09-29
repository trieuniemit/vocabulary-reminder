<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function logout() {
        auth()->logout();
        // redirect to homepage
        return redirect('/');
    }
}
