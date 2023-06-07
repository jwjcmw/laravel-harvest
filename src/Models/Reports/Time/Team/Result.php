<?php

namespace Byte5\LaravelHarvest\Models\Reports\Time\Team;

use Byte5\LaravelHarvest\Models\User;
use Byte5\LaravelHarvest\Traits\HasExternalRelations;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasExternalRelations;

    protected $fillable = [
        'external_user_id',
        'user_name',
        'is_contractor',
        'total_hours',
        'billable_hours',
        'currency',
        'billable_amount',
        'weekly_capacity',
        'avatar_url',
    ];

    protected function getExternalRelations(): array
    {
        return ['user'];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
