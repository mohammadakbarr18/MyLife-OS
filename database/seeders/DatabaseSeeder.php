<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create or retrieve the test user
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name'     => 'Test User',
                'password' => Hash::make('password'),
            ]
        );

        $this->command->info("✅ Test User ready: test@example.com / password");

        // Seed 10 transactions (mix of 3 income + 7 expense for realism)
        Transaction::factory()
            ->count(3)
            ->income()
            ->for($user)
            ->create();

        Transaction::factory()
            ->count(7)
            ->expense()
            ->for($user)
            ->create();

        $this->command->info("✅ 10 Transactions seeded (3 income, 7 expense)");

        // Seed 5 todos (mix of pending and completed)
        Todo::factory()
            ->count(3)
            ->pending()
            ->for($user)
            ->create();

        Todo::factory()
            ->count(2)
            ->completed()
            ->for($user)
            ->create();

        $this->command->info("✅ 5 Todos seeded (3 pending, 2 completed)");
    }
}
