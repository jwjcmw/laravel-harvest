<?php

namespace Byte5\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;
use Byte5\LaravelHarvest\Traits\HasExternalRelations;

class User extends Model
{
    use HasExternalRelations;

    protected $casts = [
        'roles' => 'array',
        'has_access_to_all_future_projects' => 'boolean',
        'is_contractor' => 'boolean',
        'is_admin' => 'boolean',
        'is_project_manager' => 'boolean',
        'can_see_rates' => 'boolean',
        'can_create_projects' => 'boolean',
        'can_create_invoices' => 'boolean',
        'is_active' => 'boolean',
    ];
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = [
        'external_id', 'first_name', 'last_name', 'email', 'telephone', 'timezone',
        'has_access_to_all_future_projects', 'is_contractor', 'is_admin',
        'is_project_manager', 'can_see_rates', 'can_create_projects',
        'is_active', 'weekly_capacity', 'default_hourly_rate',
        'cost_rate', 'roles', 'avatar_url',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.users')
        );
    }

    protected function getExternalRelations(): array
    {
        return [];
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'user_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'user_id');
    }

    public function timeEntries()
    {
        return $this->hasMany(TimeEntry::class, 'user_id');
    }

    public function assignments()
    {
        return $this->hasMany(UserAssignment::class, 'user_id');
    }
}
