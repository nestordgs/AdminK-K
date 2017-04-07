<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeDoc extends Model
{
    protected $fillable = [
        'name', 'initial'
    ];

    protected $table = 'type_docs';
}
