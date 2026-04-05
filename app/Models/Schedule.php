<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'date',
        'start_time',
        'end_time',
        'icon',
        'note',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date'       => 'date',
            'start_time' => 'datetime:H:i',
            'end_time'   => 'datetime:H:i',
        ];
    }

    /**
     * Get the user that owns the schedule.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope: order schedules by start_time ascending.
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('start_time', 'asc');
    }
}
