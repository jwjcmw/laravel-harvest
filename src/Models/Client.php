<?php

namespace Byte5\LaravelHarvest\Models;

use Byte5\LaravelHarvest\Traits\HasExternalRelations;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasExternalRelations;

    protected $casts = [
        'is_active' => 'boolean',
    ];
    protected array $dates = ['created_at', 'updated_at'];
    protected $fillable = [
        'external_id', 'currency', 'name', 'is_active', 'address',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix') . config('harvest.table_names.clients')
        );
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function timeEntries()
    {
        return $this->hasMany(TimeEntry::class);
    }

    protected function getExternalRelations(): array
    {
        return [];
    }
}
