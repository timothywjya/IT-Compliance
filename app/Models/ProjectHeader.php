<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectHeader extends Model
{
    protected $table    = 'project_header';
    protected $fillable = [
        'application_name',
        'program_version',
        'developed_by',
        'prpk_id',
        'pic_prpk',
        'name_pic_prpk',
        'memo_id',
        'pic_memo',
        'name_pic_memo',
        'developer_testing',
        'support_testing',
        'test_date',
        'created_by',
        'updated_by',
    ];

    public function developer()
    {
        return $this->belongsTo(User::class, 'developed_by');
    }
    public function picPrpk()
    {
        return $this->belongsTo(User::class, 'pic_prpk');
    }
    public function picMemo()
    {
        return $this->belongsTo(User::class, 'pic_memo');
    }
    public function developerTesting()
    {
        return $this->belongsTo(User::class, 'developer_testing');
    }
    public function supportTesting()
    {
        return $this->belongsTo(User::class, 'support_testing');
    }
    public function prpk()
    {
        return $this->belongsTo(MasterTicketing::class, 'prpk_id');
    }
    public function memo()
    {
        return $this->belongsTo(MasterTicketing::class, 'memo_id');
    }
    public function information()
    {
        return $this->hasOne(ProjectInformation::class, 'project_header_id');
    }
    public function details()
    {
        return $this->hasMany(ProjectDetail::class, 'project_header_id');
    }
}
