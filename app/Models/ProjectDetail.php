<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectDetail extends Model
{
    protected $table    = 'project_detail';
    protected $fillable = [
        'project_header_id',
        'testing_scenario',
        'target',
        'testing_by_support',
        'testing_by_programmer',
        'created_by',
        'updated_by',
    ];

    public function projectHeader()
    {
        return $this->belongsTo(ProjectHeader::class, 'project_header_id');
    }
}
