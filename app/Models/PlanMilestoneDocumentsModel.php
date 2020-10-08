<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanMilestoneDocumentsModel extends Model
{
    protected $table = "pln_milestone_documents";
    
    public $primaryKey = "mdc_id";

    public $timestamps = false;

    protected $fillable = [
        'mls_id', //int
        'date_uploaded', //date
        'name', //varchar
        'size', //int
        'type', //varchar
        'content' //longblob
    ];
    
}
