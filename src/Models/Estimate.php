<?php

namespace Byte5\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;
use Byte5\LaravelHarvest\Traits\HasExternalRelations;

class Estimate extends Model
{
    use HasExternalRelations;

    protected $casts = [
        'line_items' => 'array',
    ];
    protected $dates = [
        'created_at', 'updated_at', 'issue_date', 'sent_at', 'accepted_at', 'declined_at',
    ];
    protected $fillable = [
        'external_id', 'creator_id', 'line_items', 'client_key', 'number', 'purchase_order',
        'amount', 'tax', 'tax_amount', 'tax2', 'tax2_amount', 'discount', 'discount_amount',
        'subject', 'notes', 'currency', 'issue_date', 'sent_at', 'accepted_at',
        'declined_at', 'discount_amount', 'client_id',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.estimates')
        );
    }

    protected function getExternalRelations(): array
    {
        return ['client', 'creator'];
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }
}
