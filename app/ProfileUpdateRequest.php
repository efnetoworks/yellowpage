<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileUpdateRequest extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(Logistic::class);
    }
}
