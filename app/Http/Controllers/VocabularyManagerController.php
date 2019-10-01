<?php

namespace App\Http\Controllers;

use App\Vocabulary;
use Illuminate\Http\Request;

class VocabularyManagerController extends Controller
{
    public function getdata(Request $request){
        $start = $request->get('start');
        $length = $request->get('length');
        $vocabulary = Vocabulary::offset($start)->limit(10)->get();
        return response()->json(['data' => $vocabulary, 'recordsFiltered' => Vocabulary::count(), 'recordsTotal' => Vocabulary::count(), 'raws' => 1]);
    }

}
