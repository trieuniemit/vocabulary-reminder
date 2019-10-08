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
        $urlArr = [];
        
        if(isset($request->q)) {
            //search
            $vocas = Vocabulary::where('word', 'like', '%'.($request->q).'%')->orderBy('word');
            
            $urlArr = array(
                'q' => $request->q
            );
        } else if(isset($request->type)) {
            //with fillter
            $vocas = Vocabulary::whereHas('means', function ($query) use ($request){
                $query->where('type', '=', $request->type);
            })->orderBy('word');
            
            $urlArr = array(
                'type' => request()->type, 
                'cat' => request()->cat
            );
        } else {
            //no search, no filtter
            $vocas = Vocabulary::orderBy('word');
        }

        //paginate by 48 per page
        $vocas = $vocas->paginate(48);
        //load relationship
        $vocas->load('means');

        return view('vocabulary', compact('vocas', 'urlArr'));
    }

    function vocabularyDetail($word) {
        $voca = Vocabulary::where('word', $word)->first();
        $voca->load('means');
        return view('vocabulary_detail', compact('voca'));
    }
}
