<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanDocumentsModel extends Model
{
    protected $table = 'pln_documents';

    public $timestamps = false;
    
    public $primaryKey = 'pdc_id';

    protected $fillable = [
        'pln_id',
        'date_uploaded',
        'document_name',
        'document_size',
        'document_type',
        'content'
    ];
}
