<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class Logistic extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $guarded = [];
    protected $guard = 'logistic';



    public function delivery_requests()
    {
        return $this->hasMany(DeliveryRequest::class);
    }
}
