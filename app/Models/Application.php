<?php

namespace App\Models;

use App\Enums\ApplicationActionEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dob',
        'gender',
        'nationality',
        'cv',
        'coordinator_action',
        'manager_action',
        'coordinator_id',
        'manager_id',
    ];

    protected $casts = [
        'coordinator_action' => ApplicationActionEnum::class,
        'manager_action' => ApplicationActionEnum::class
    ];

    protected function gender(): Attribute
    {
        return Attribute::get(function($value) {
           return match ($value) {
               'male' => 'ذكر',
               'female' => 'انثى'
           };
        });
    }

    public function coordinator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'coordinator_id');
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function scopeWaitingForCoordinator(Builder $query): void
    {
        $query->where('coordinator_action', ApplicationActionEnum::PENDING);
    }

    public function scopeWaitingForManager(Builder $query): void
    {
        $query
            ->where('coordinator_action', ApplicationActionEnum::ACCEPTED)
            ->where('manager_action', ApplicationActionEnum::PENDING);
    }
}
