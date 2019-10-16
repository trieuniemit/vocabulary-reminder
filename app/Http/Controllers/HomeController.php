<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Vocabulary;

class HomeController extends Controller
{
    function __construct() {

    }

    function index() {
        return view('home');
        if(Auth::check()) {
            return redirect(route('admin_home'));   
        }
        $vocas = Vocabulary::orderBy('created_at')->limit(18)->get();
        //load relationship
        $vocas->load('means');
        return view('home_page', compact('vocas'));
    }
    
    function quickSearch(Request $request) {
        if(isset($request->q)) {
            //search
            $vocas = Vocabulary::where('word', 'like', ($request->q).'%')->orderBy('word');
            
            //paginate by 10 per page
            $vocas = $vocas->limit(10)->get();

            //load relationship
            $vocas->load('means');

            $returnArr = [];

            foreach($vocas as $vo) {
                $returnArr[] = [
                    'word' => $vo->word,
                    'mean' => count($vo->means) > 0?($vo->means[0]->mean): '',
                    'type' => count($vo->means) > 0?($vo->means[0]->type): '',
                    'link' => getVocaLink($vo->word)
                ];
            }

            return response($returnArr);
        }
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

}
