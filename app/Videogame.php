<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videogame extends Model
{
    protected $fillable =[

        'title',
        'subtitle',
        'release_date',
        'pegi',

    ];
}
