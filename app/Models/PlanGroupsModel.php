<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanGroupsModel extends Model
{
    protected $table = 'pln_groups';

    public $timestamps = false;

    public $primaryKey = 'pgr_id';

    protected $fillable = [
        'pct_id', //int
        'pln_id', //int
        'id_group' //int
    ];
}
