<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class SystemController extends Controller {

    function index() {
        return view('admin.system_settings');
    }

}
