<?php

namespace Byte5\LaravelHarvest\Models\Reports\Time\Project;

use Byte5\LaravelHarvest\Models\Client;
use Byte5\LaravelHarvest\Models\Project;
use Byte5\LaravelHarvest\Traits\HasExternalRelations;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasExternalRelations;

    protected $fillable = [
        'external_project_id',
        'project_name',
        'external_client_id',
        'client_name',
        'total_hours',
        'billable_hours',
        'currency',
        'billable_amount',
    ];

    protected function getExternalRelations(): array
    {
        return [
            'client',
            'project',
        ];
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
