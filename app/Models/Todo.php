<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
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
        'status',
        'task_priority_id',
        'due_date',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'due_date' => 'date',
        ];
    }

    /**
     * Get the user that owns the todo.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the priority assigned to the todo.
     */
    public function taskPriority(): BelongsTo
    {
        return $this->belongsTo(TaskPriority::class);
    }
}
