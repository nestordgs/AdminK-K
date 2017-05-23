<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeWork extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'abbreviation', 'active'
    ];

    protected $table = 'type_works';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function works()
    {
        return $this->hasMany('App\Work');
    }
}
