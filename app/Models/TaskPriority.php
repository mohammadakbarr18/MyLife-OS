<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskPriority extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'color',
    ];

    /**
     * Get the user that owns the priority.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all todos using this priority.
     */
    public function todos(): HasMany
    {
        return $this->hasMany(Todo::class);
    }

    /**
     * Default priorities for new and legacy users.
     *
     * @return array<int, array{name: string, color: string}>
     */
    public static function defaults(): array
    {
        return [
            ['name' => 'High', 'color' => '#DC2626'],
            ['name' => 'Medium', 'color' => '#D97706'],
            ['name' => 'Low', 'color' => '#2563EB'],
        ];
    }

    /**
     * Seed default priorities for a user when they do not have any yet.
     */
    public static function ensureDefaultsForUser(User $user): void
    {
        if ($user->taskPriorities()->exists()) {
            return;
        }

        $user->taskPriorities()->createMany(static::defaults());
    }
}
