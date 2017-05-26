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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeWork()
    {
        return $this->belongsTo('App\TypeWork');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unitOfMeasure()
    {
        return $this->belongsTo('App\UnitOfMeasure','unit_of_measure_id');
    }

    /**
     * @param $directCost
     * @return float|int
     */
    public static function calculateAdminCost($directCost)
    {
        return $directCost * 10 / 100;
    }

    /**
     * @param $directCost
     * @return float|int
     */
    public static function calculateUtility($directCost)
    {
        return $directCost * 30 / 100;
    }
}
