<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanMilestonesFilesModel extends Model
{
    protected $table = 'pln_milestones_files';

    public $timestamps = false;

    public $primaryKey = 'id';

    protected $fillable = [
        'mls_id',
        'name',
        'size',
        'type',
        'url',
        'title',
        'description',
        'content'
    ];
}
