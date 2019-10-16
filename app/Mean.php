<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mean extends Model
{
    public function vocabulary()
    {
    	return $this->belongsTo(Vocabulary::class);
    }
}
