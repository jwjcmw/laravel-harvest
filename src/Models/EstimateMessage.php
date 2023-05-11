<?php

namespace Byte5\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

class EstimateMessage extends Model
{
    protected $casts = [
        'recipients' => 'array',
        'send_me_a_copy' => 'boolean',
        'event_type' => 'boolean',
    ];
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = [
        'external_id', 'sent_by', 'sent_by_email', 'sent_from', 'recipients',
        'subject', 'body', 'send_me_a_copy', 'event_type',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.estimate_messages')
        );
    }
}
