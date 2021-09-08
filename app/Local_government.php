<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local_government extends Model
{
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function logistics()
    {
        return $this->hasMany(Logistic::class);
    }
}
