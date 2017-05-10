<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'direct_cost', 'admin_cost', 'utility', 'type_work_id', 'unit_of_measure_id',
    ];

    protected $table = 'works';
}
