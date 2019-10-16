<?php

namespace App\Http\Controllers;


use App\Commons\ResponseCode;
use App\Commons\JsonResponse;
use Illuminate\Http\Request;
use App\Vocabulary;
use App\Mean;
use Auth;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class VocabularyController extends Controller
{
    //lấy dữ liệu đổ ra bảng
    public function getandfill(Request $request)
    {
        $start = $request->start;
        $limit = $request->length;
        if (Auth::user()->role == 2) {
            $vocabulary = array_values(Vocabulary::with('means')->orderBy("created_at", 'DESC')->where("user_id", Auth::id())
                ->offset($start)->limit($limit)->get()->toArray());
        } else {
            $vocabulary = array_values(Vocabulary::with('means')->orderBy("created_at", 'DESC')
                ->offset($start)->limit($limit)->get()->toArray());
        }
        return response()->json(['data' => $vocabulary, 'recordsFiltered' => Vocabulary::count(), 'recordsTotal' => Vocabulary::count(), 'raws' => 1]);
    }

//    public static function getVocabulary($id=0){
//        $vocabulary = App\Vocabulary::all();
//
//        try{
//            if($id==0){
//                $->orderBy('id', 'asc')->get();
//            }else{
//                $value=DB::table('Vocabularies')->where('id', $id)->first();
//            }
//            return $value;
//        }catch (Exception $exception)
//        {
//            return $exception;
//        }
//    }

    public function insertData($data)
    {
        $value = DB::table('Vocabularies')->where('word', $data['word'])->get();
        try {
            DB::table('Vocabularies')->insert($data);
            return 1;
        } catch (Exception $exception) {
            return $exception;
        }
    }

    public function edit(Request $request, $id)
    {
        $result = new JsonResponse();
        try {

            if ($id == -1) {
                $voca = new  Vocabulary($request->all());
                $voca->user_id = Auth::id();
                $voca->save();
                $mean = new Mean($request->all()["means"]);
                $mean->vocabulary_id = $voca->id;
                $mean->save();

            } else {
                $vocab = Vocabulary::find($id);
                $mean = Mean::where("vocabulary_id", $id);
                $vocab->update($request->all());
                if (!empty($mean)) {
                    $mean->update($request->all()["means"]);
                }
            }
            $result->success(true);
        } catch (Exception $exception) {
            $result->fail($exception->getMessage());
        }
        return $result;
    }

    public function delete($id)
    {
        $result = new JsonResponse();
        try {
            $voc = Vocabulary::find($id);
            $mean = Mean::where("vocabulary_id", $id);
            if (empty($voc)) {
                $result->fail(ResponseCode::fail, 'Có lỗi xảy ra, vui lòng thử lại sau!');
            } else {
                Mean::where("vocabulary_id", $id)->delete();
                $result->success(Vocabulary::find($id)->delete());
            }
        } catch (Exception $exception) {
            $result->fail($exception->getMessage());
        }
        return $result;
    }
}
