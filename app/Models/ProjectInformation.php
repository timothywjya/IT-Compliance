<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectInformation extends Model
{
    protected $table    = 'project_information';
    protected $fillable = [
        'project_header_id',
        'needs',
        'location',
        'configuration',
        'special_condition',
        'dependency',
        'created_by',
        'updated_by',
    ];

    public function projectHeader()
    {
        return $this->belongsTo(ProjectHeader::class, 'project_header_id');
    }
}
