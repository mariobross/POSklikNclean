<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    protected $fillable = [
        'username', 
        'password', 
        'name', 
        'email', 
        'address',
        'phone'
    ];

}
