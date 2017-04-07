<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'id_type_doc', 'number_rif', 'address', 'email', 'contact',
    ];

    protected $table = 'clients';

    public function type_doc()
    {
        return $this->hasOne('App\TypeDoc', 'id');
    }
}
