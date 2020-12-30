<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Driver extends Authenticatable
{
    use Notifiable;

    protected $guard = 'driver';

    protected $fillable = [
        'name', 'email', 'password', 'age', 'mobile_no', 'license', 'address', 'image', 'latitude', 'longitude',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
