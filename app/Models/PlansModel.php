<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlansModel extends Model
{
    protected $table = "pln_plans";
    
    public $primaryKey = "pln_id";

    public $timestamps = false;

    protected $fillable = [
        'id_company',
        'plan_name',
        'planned_start_date',
        'planned_end_date',
        'actual_start_date',
        'actual_end_date',
        'plan_code',
        'pln_termination',
        'percentage'
    ];
}
