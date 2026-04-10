<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterTicketing extends Model
{
    protected $table    = 'master_ticketing';
    protected $fillable = ['ticket_number', 'ticket_type', 'subject', 'description', 'created_by', 'updated_by'];

    public function projectsAsPrpk()
    {
        return $this->hasMany(ProjectHeader::class, 'prpk_id');
    }
    public function projectsAsMemo()
    {
        return $this->hasMany(ProjectHeader::class, 'memo_id');
    }
}
