<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kpsi extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'target_value',
        'project_id',
        'type',
        'achieved',
    ];

    /**
     * Relation avec le projet (un KPI appartient à un projet).
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
