<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Vocabulary extends Model
{
    public function means()
    {
    	return $this->hasMany(Mean::class, 'vocabulary_id');
    }
    public  static  function  getAll($start,$limit){
        $vocabulary = DB::table('Vocabularies')
            ->join('Means','Means.vocabulary_id','=','Vocabularies.id')
            ->offset($start)->limit($limit)->get()->toArray();
        return $vocabulary;
    }
    public static function getVocabulary($id=0){

        if($id==0){
            $value=DB::table('Vocabularies')->orderBy('id', 'asc')->get();
        }else{
            $value=DB::table('Vocabularies')->where('id', $id)->first();
        }
        return $value;
    }

    public static function insertData($data){
        $value=DB::table('Vocabularies')->where('word', $data['word'])->get();
        if($value->count() == 0){
            DB::table('Vocabularies')->insert($data);
            return 1;
        }else{
            return 0;
        }

    }

    public static function updateData($id,$data){
        DB::table('Vocabularies')
            ->where('id', $id)
            ->update($data);
    }

    public static function deleteData($id){
        DB::table('Vocabularies')->where('id', '=', $id)->delete();
    }
}
