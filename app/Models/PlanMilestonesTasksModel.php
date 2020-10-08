<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanMilestonesTasksModel extends Model
{
    protected $table = 'pln_milestones_tasks';

    public $timestamps = false;

    public $primaryKey = 'tsk_id';

    protected $fillable = [
        'mls_id',
        'task_name',
        'percentage',
        'is_completed',
        'planned_startdate',
        'planned_enddate',
        'actual_startdate',
        'actual_endate'
    ];
}
