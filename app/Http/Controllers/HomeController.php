<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Vocabulary;

class HomeController extends Controller
{
    function __construct() {

    }

    function index() {
        return view('home');
    }

    function vocabulary(Request $request) {
        $vocas = null;

        if(isset($request->type)) {
            $vocas = Vocabulary::whereHas('means', function ($query) use ($request){
                $query->where('type', '=', $request->type);
            })->paginate(48);
        } else {
            $vocas = Vocabulary::paginate(48);
        }

        $vocas->load('means');

        return view('vocabulary', compact('vocas'));
    }

}
