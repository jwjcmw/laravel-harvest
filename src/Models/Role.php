<?php

namespace Byte5\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $casts = [
        'user_ids' => 'array',
    ];
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = ['external_id', 'name', 'user_ids'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.roles')
        );
    }
}
