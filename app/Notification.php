<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = ['data'];
    protected $dates = ["read_at",'created_at','updated_at'];

    public function means()
    {
//        return $this->hasMany(Mean::class);
    }
}
