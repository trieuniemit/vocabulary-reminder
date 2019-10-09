<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Mean extends Model
{
    protected $fillable = ["mean","vocabulary_id","type"];
    public function vocabulary()
    {
    	return $this->belongsTo(Vocabulary::class,'vocabulary_id','id');
    }
//    public static function getMean($id=0){
//
//        if($id==0){
//            $value=DB::table('means')->orderBy('id', 'asc')->get();
//        }else{
//            $value=DB::table('means')->where('id', $id)->first();
//        }
//        return $value;
//    }
//
//    public static function insertData($data){
//        $value=DB::table('means')->where('vocabulary_id', $data['id'])->get();
//        if($value->count() == 0){
//            DB::table('means')->insert($data);
//            return 1;
//        }else{
//            return 0;
//        }
//    }
//
//    public static function updateData($id,$data){
//        DB::table('means')->where('id', $id)->update($data);
//    }
//
//    public static function deleteData($id){
//        DB::table('means')->where('id', '=', $id)->delete();
//    }
}
