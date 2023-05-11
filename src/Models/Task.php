<?php

namespace Byte5\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $casts = [
        'billable_by_default' => 'boolean',
        'is_default' => 'boolean',
        'is_active' => 'boolean',
    ];
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = [
        'external_id', 'name', 'billable_by_default', 'default_hourly_rate',
        'is_default', 'is_active',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.tasks')
        );
    }

    public function timeEntries()
    {
        return $this->hasMany(TimeEntry::class);
    }
}
