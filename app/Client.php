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

    /**
     * Get the name with Title Case
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return title_case($value);
    }

    /**
     * Get the Contact with Title Case
     *
     * @param  string  $value
     * @return string
     */
    public function getContactAttribute($value)
    {
        return title_case($value);
    }

    /**
     * Set Relationship with typeDocs table
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type_doc()
    {
        return $this->hasOne('App\TypeDoc', 'id','id_type_doc');
    }

    public function phones()
    {
        return $this->hasMany('App\ClientPhone');
    }
}
