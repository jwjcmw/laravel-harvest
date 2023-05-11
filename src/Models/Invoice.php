<?php

namespace Byte5\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;
use Byte5\LaravelHarvest\Traits\HasExternalRelations;

class Invoice extends Model
{
    use HasExternalRelations;

    protected $casts = [
        'line_items' => 'array',
    ];
    protected $dates = [
        'created_at', 'updated_at', 'period_start', 'period_end',
        'issue_date', 'due_date', 'sent_at', 'paid_at', 'closed_at',
    ];
    protected $fillable = [
        'external_id', 'client_id', 'estimate_id', 'retainer_id', 'creator_id', 'line_items',
        'client_key', 'number', 'purchase_order', 'amount', 'due_amount', 'tax', 'tax_amount',
        'tax2', 'tax2_amount', 'discount', 'discount_amount', 'subject', 'notes', 'currency',
        'state', 'period_start', 'period_end', 'issue_date', 'due_date', 'sent_at', 'paid_at', 'closed_at',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.invoices')
        );
    }

    protected function getExternalRelations(): array
    {
        return [
            'client',
            'estimate',
            'creator' => 'user',
        ];
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function estimate()
    {
        return $this->belongsTo(Estimate::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
