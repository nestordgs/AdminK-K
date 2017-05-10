<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UniteOfMeasure extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'abbreviation'
    ];

    protected $table = 'unit_of_measure';
}
