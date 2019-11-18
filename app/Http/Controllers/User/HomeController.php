<?php

namespace App\Http\Controllers\User;
use \Validator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Vocabulary;

class HomeController extends Controller
{

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

        return view('user.dictionary', compact('vocas', 'urlArr', 'title'));
    }

    function vocabularyDetail($word) {
        $title = 'Nghĩa của từ '.$word;

        $voca = Vocabulary::where('word', $word)->first();
        $voca->load('means');
        return view('user.vocabulary_detail', compact('voca', 'title'));
    }

    function getUserProfile() {
        $user = Auth::user();
        $title = 'Thông tin cá nhân';

        return view('user.profile', compact('user', 'title'));
    }

    function postUserProfile(Request $request) {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => 'required',
            'birthday' => 'required'
        ]);

        if ($validator->fails()) {

            return redirect(route('user_profile'))
                ->withErrors($validator)
                ->withInput();

        } else {
            $user = Auth::user();
            $user->fullname = $request->fullname;
            $user->email = $request->email;
            $user->gender = $request->gender;
            $user->birthday = $request->birthday;
            $user->save();
        }

        return redirect(route('user_profile'));

    }
}
