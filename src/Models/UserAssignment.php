<?php

namespace Byte5\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;
use Byte5\LaravelHarvest\Traits\HasExternalRelations;

class UserAssignment extends Model
{
    use HasExternalRelations;

    protected $casts = [
        'is_active' => 'boolean',
        'is_project_manager' => 'boolean',
    ];
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = [
        'external_id', 'user_id', 'is_active', 'is_project_manager', 'hourly_rate', 'budget',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.user_assignments')
        );
    }

    protected function getExternalRelations(): array
    {
        return ['user'];
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
