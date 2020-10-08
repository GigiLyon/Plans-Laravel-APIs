<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EbrGroupsModel extends Model
{
    protected $table = 'ebr_groups';

    protected $primaryKey = 'id_group';

    public $timestamps = false;

    protected $fillable = [
        'parent_id',
        'group_name',
        'id_company',
        'gcd_id',
        'group_admin',
        'group_ccp',
        'group_showcom',
        'is_evaluated',
        'has_folders',
        'cm_display',
        'one_member',
        'is_meeting_group',
        'chairman',
        'rank',
        'is_admin',
        'self_managed',
        'message',
        'non_sys_users',
        'color_code'
    ];
}
