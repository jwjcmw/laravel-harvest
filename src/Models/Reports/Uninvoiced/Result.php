<?php

namespace Byte5\LaravelHarvest\Models\Reports\Uninvoiced;

use Byte5\LaravelHarvest\Models\Client;
use Byte5\LaravelHarvest\Models\Project;
use Byte5\LaravelHarvest\Traits\HasExternalRelations;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int external_client_id
 * @property string client_name
 * @property int external_project_id
 * @property string project_name
 * @property string currency
 * @property float total_hours
 * @property float total_expenses
 * @property float uninvoiced_hours
 * @property float uninvoiced_expenses
 * @property float uninvoiced_amount
 */
class Result extends Model
{
    use HasExternalRelations;

    protected $fillable = [
        'external_client_id',
        'client_name',
        'external_project_id',
        'project_name',
        'currency',
        'total_hours',
        'uninvoiced_hours',
        'uninvoiced_expenses',
        'uninvoiced_amount',
    ];

    public function __construct(
        array $attributes = []
    ) {
        parent::__construct($attributes);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    protected function getExternalRelations(): array
    {
        return [
            'client',
            'project'
        ];
    }
}