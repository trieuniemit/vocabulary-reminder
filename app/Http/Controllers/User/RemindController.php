<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vocabulary;
use App\Remind;


class RemindController extends Controller
{
    function index() {
        $list = Remind::Where('user_id','=',\Auth::user()->id)->get();
        return view('user.remind',['arr' => $this->notification(),'list' => $list]);
    }

    function create(Request $request) {
    	$tieude = $request->input('tieude');
    	$ngaybatdau = $request->input('ngaybatdau');
    	$ngayketthuc = $request->input('ngayketthuc');
    	$tuvung = trim($request->input('tuvung'), ',');
    	$remind = new Remind();
        $remind->title = $tieude;
        $remind->user_id = \Auth::user() -> id;
    	$remind->start_date = $ngaybatdau;
    	$remind->end_date = $ngayketthuc;
    	$remind->vocabs = '['.$tuvung.']';
    	$remind->save();

    	return back();
    }
    function search(Request $request){
    	 $search = $request->input('search');
    	 $arr = Vocabulary::with('means')->Where('word', 'like', '%' . $search . '%')->skip(0)->take(10)->get();

    	 return response()->json($arr);
    }

    function notification(){
        $date =  date('Y-m-d', time());
        $arr = Remind::select('vocabs')->Where([['user_id','=',\Auth::user()->id],['start_date','<=',$date],['end_date','>=',$date]])->get();
        $vocabs = [];
        if(count($arr)==0) {return;}
        foreach ($arr as $key => $value){
                $check = explode(',', trim(trim($value->vocabs, ']'),'['));
                foreach ($check as $key => $value) {
                    if(in_array($value, $vocabs)){
                        continue;
                    }else{
                        array_push($vocabs, $value);
                    }
                }            
            }
        $arr = Vocabulary::whereIn('id', $vocabs)->get();
        return $arr;
    }

    function delete(Request $request){
        $id = $request->input('idRemind');
        $result = Remind::Where('id','=',$id)->delete();
        return back(); 
    }
}
