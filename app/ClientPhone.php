<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientPhone extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id', 'number'
    ];

    protected $table = 'client_phones';

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
