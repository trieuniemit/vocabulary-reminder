<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vocabulary;
use App\Remind;

class RemindController extends Controller
{
    function index() {
        return view('remind');
    }

    function create(Request $request) {
    	$tieude = $request->input('tieude');
    	$ngaybatdau = $request->input('ngaybatdau');
    	$ngayketthuc = $request->input('ngayketthuc');
    	$ghichu = $request->input('ghichu');
    	$tuvung = trim($request->input('tuvung'), ',');
    	$remind = new Remind();
        $remind->title = $tieude;
        $remind->user_id = '1';
    	$remind->start_date = $ngaybatdau;
    	$remind->end_date = $ngayketthuc;
    	//$remind->ghichu = $ghichu;
    	$remind->vocabs = '['.$tuvung.']';
    	$remind->save();

    	return back();
    }
    function search(Request $request){
    	 $search = $request->input('search');
    	 $arr = Vocabulary::with('means')->Where('word', 'like', '%' . $search . '%')->skip(0)->take(10)->get();

    	 return response()->json($arr);
    }
}
