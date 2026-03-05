<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
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
        'icon',
        'type',
    ];

    /**
     * Get the user that owns the category.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include income categories.
     */
    public function scopeIncome($query)
    {
        return $query->where('type', 'income');
    }

    /**
     * Scope a query to only include expense categories.
     */
    public function scopeExpense($query)
    {
        return $query->where('type', 'expense');
    }

    /**
     * Default categories to seed for new users.
     */
    public static function defaults(): array
    {
        return [
            ['name' => 'Salary',        'icon' => '💰', 'type' => 'income'],
            ['name' => 'Freelance',     'icon' => '💻', 'type' => 'income'],
            ['name' => 'Bonus',         'icon' => '🎉', 'type' => 'income'],
            ['name' => 'Food',          'icon' => '🍔', 'type' => 'expense'],
            ['name' => 'Transport',     'icon' => '🚗', 'type' => 'expense'],
            ['name' => 'Bills',         'icon' => '📄', 'type' => 'expense'],
            ['name' => 'Entertainment', 'icon' => '🎮', 'type' => 'expense'],
            ['name' => 'Shopping',      'icon' => '🛍️', 'type' => 'expense'],
        ];
    }
}
