<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vocabulary;


class VocabularyController extends Controller
{
    public static function getdata(Request $request)
    {
        $start = $request->get('start');
        $length = $request->get('length');
        $data = Vocabulary::getAll($start,$length);
//        dd($data);
        return response()->json(['data'=> $data,'recordsFiltered' => Vocabulary::count(), 'recordsTotal' => Vocabulary::count(), 'raws' => 1]);
    }
}
