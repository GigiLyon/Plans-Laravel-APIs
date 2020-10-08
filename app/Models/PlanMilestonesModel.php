<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanMilestonesModel extends Model
{
    protected $table = 'pln_milestones';

    public $timestamps = false;

    public $primaryKey = 'mls_id';

    protected $fillable = [
        'pln_id', 
        'milestone', 
        'planned_date',
        'actual_date',
        'percentage',
        'percentage_progress',
        'm_code',
        'DT_RowId'
    ];
}
