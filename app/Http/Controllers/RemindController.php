<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RemindController extends Controller
{
    function getRemind() {
        $title = 'Nhắc nhở từ vựng';
        return view('user.remind', compact('title'));
    }
}
