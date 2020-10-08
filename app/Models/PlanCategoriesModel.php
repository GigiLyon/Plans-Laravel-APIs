<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanCategoriesModel extends Model
{
    protected $table = 'pln_categories';

    public $primaryKey = 'pct_id';

    public $timestamps = false;

    protected $fillable = [
        'category_name'
    ];

}
