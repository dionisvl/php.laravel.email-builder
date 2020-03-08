<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    /**
     * Get the type record associated with the block.
     */
    public function type()
    {
        return $this->belongsTo('App\Type');
    }
}
