<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Vocabulary;

class HomeController extends Controller
{
    
    function getUserProfile() {
        $user = Auth::user();
        $title = 'Thông tin cá nhân';

        return view('user.profile', compact('user', 'title'));
    }

    function vocabularies(Request $request) {
        $vocas = null;
        $urlArr = [];
        
        $title = 'Từ điển Anh - Việt';

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
        $vocas = $vocas->paginate(130);
        //load relationship
        $vocas->load('means');

        return view('user.new_vocabularies', compact('vocas', 'urlArr', 'title'));
    }
}
