<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Exception;
use App\result;

class Vocabulary extends Model
{
    protected $table = 'vocabularies';
    protected $fillable = ['word','user_id','spelling','rate','views','status'];
    protected $dates = ['created_at','updated_at'];
    public function Mean()
    {
        return $this->hasOne(Mean::class);
    }
}
