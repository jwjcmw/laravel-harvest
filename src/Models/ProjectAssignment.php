<?php

namespace Byte5\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;
use Byte5\LaravelHarvest\Traits\HasExternalRelations;

class ProjectAssignment extends Model
{
    use HasExternalRelations;

    protected $casts = [
        'task_assignments' => 'array',
        'is_active' => 'boolean',
        'is_project_manager' => 'boolean',
    ];
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = [
        'external_id', 'project_id', 'client_id', 'is_active', 'is_project_manager',
        'hourly_rate', 'budget', 'task_assignments',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.project_assignments')
        );
    }

    protected function getExternalRelations(): array
    {
        return ['project', 'client'];
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
