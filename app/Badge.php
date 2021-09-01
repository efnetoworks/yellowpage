<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    public function referred()
    {
        return $this->belongsTo('App\Referal');
    }
}
