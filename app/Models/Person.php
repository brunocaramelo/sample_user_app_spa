<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'user_person';
    protected $fillable = [
        'name',
        'lastname',
        'cep',
        'street',
        'city',
        'street_number',
        'state',
        'neighborhood',
    ];
}
