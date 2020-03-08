<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function block()
    {
        return $this->belongsTo('App\Block');
    }
}
