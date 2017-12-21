<?php

namespace Naoray\LaravelHarvest\Models;

class UserAssignment extends BaseModel
{
    /**
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'is_project_manager' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $fillable = [
        'external_id', 'user_id', 'is_active', 'is_project_manager', 'hourly_rate', 'budget',
    ];

    /**
     * @var array
     */
    protected $transformable = [
        'user' => 'relation',
    ];

    /**
     * UserAssignment constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.user_assignments')
        );
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}