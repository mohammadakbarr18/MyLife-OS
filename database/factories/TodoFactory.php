<?php

namespace Database\Factories;

use App\Models\TaskPriority;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    protected $model = Todo::class;

    /**
     * Configure the factory.
     */
    public function configure(): static
    {
        return $this
            ->afterMaking(function (Todo $todo) {
                $this->assignTaskPriority($todo);
            })
            ->afterCreating(function (Todo $todo) {
                if ($todo->task_priority_id !== null) {
                    return;
                }

                $this->assignTaskPriority($todo);
                $todo->save();
            });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titles = [
            'Selesaikan Tugas Laravel',
            'Meeting dengan Klien',
            'Olahraga Sore',
            'Belajar React.js',
            'Beli Groceries',
            'Review Pull Request',
            'Update Portfolio Website',
            'Bayar Tagihan Listrik',
            'Baca Buku 30 Menit',
            'Backup Database Server',
            'Kirim Invoice Klien',
            'Rapikan Meja Kerja',
            'Call dengan Tim Design',
            'Push Code ke GitHub',
            'Cek Email Penting',
        ];

        return [
            'title' => fake()->unique()->randomElement($titles),
            'status' => fake()->randomElement(['pending', 'pending', 'completed']),
            'task_priority_id' => null,
            'due_date' => fake()->dateTimeBetween(now()->subDays(2), now()->addDays(5))->format('Y-m-d'),
        ];
    }

    /**
     * Set the todo as completed.
     */
    public function completed(): static
    {
        return $this->state(fn () => ['status' => 'completed']);
    }

    /**
     * Set the todo as pending.
     */
    public function pending(): static
    {
        return $this->state(fn () => ['status' => 'pending']);
    }

    /**
     * Assign a random priority owned by the todo's user.
     */
    private function assignTaskPriority(Todo $todo): void
    {
        if ($todo->task_priority_id !== null || $todo->user_id === null) {
            return;
        }

        $todo->task_priority_id = TaskPriority::query()
            ->where('user_id', $todo->user_id)
            ->inRandomOrder()
            ->value('id');
    }
}
