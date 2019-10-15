<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Address extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'street', 'number', 'user_id'
    ];

    public function getFillable()
    {
        return
            [
                'street'=>'street',
                'number'=>'number',
            ];
    }



}
