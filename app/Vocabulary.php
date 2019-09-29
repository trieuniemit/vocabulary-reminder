<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vocabulary extends Model
{
    public function means()
    {
    	return $this->hasMany(Mean::class, 'vocabulary_id');
    }
}
