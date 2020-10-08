<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanFilesModel extends Model
{
    //
    protected $table = 'pln_plan_files';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'pln_id',
        'name',
        'size',
        'type',
        'url',
        'title',
        'description',
        'content'
    ];
}
