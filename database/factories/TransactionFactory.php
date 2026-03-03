<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    /**
     * Income categories with realistic IDR amounts.
     */
    private const INCOME_CATEGORIES = [
        'Salary'    => [3000000, 8000000],
        'Freelance' => [500000, 3000000],
        'Bonus'     => [200000, 1500000],
    ];

    /**
     * Expense categories with realistic IDR amounts.
     */
    private const EXPENSE_CATEGORIES = [
        'Food'          => [15000, 75000],
        'Transport'     => [10000, 50000],
        'Bills'         => [100000, 500000],
        'Entertainment' => [25000, 150000],
        'Shopping'      => [50000, 300000],
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['income', 'expense']);

        if ($type === 'income') {
            $category = fake()->randomElement(array_keys(self::INCOME_CATEGORIES));
            [$min, $max] = self::INCOME_CATEGORIES[$category];
        } else {
            $category = fake()->randomElement(array_keys(self::EXPENSE_CATEGORIES));
            [$min, $max] = self::EXPENSE_CATEGORIES[$category];
        }

        // Round to nearest 1000 for realistic IDR amounts
        $amount = round(fake()->numberBetween($min, $max) / 1000) * 1000;

        $descriptions = [
            'Salary'        => ['Gaji Bulanan', 'Gaji Pokok Februari'],
            'Freelance'     => ['Project Website', 'Desain Logo Klien', 'Jasa Konsultasi'],
            'Bonus'         => ['Bonus Kinerja', 'THR', 'Insentif Proyek'],
            'Food'          => ['Makan Siang', 'Kopi & Snack', 'Makan Malam', 'Sarapan Pagi'],
            'Transport'     => ['Bensin Motor', 'Grab/Gojek', 'Parkir Mall', 'Isi BBM'],
            'Bills'         => ['Listrik Bulanan', 'Internet & WiFi', 'Pulsa HP', 'Air PDAM'],
            'Entertainment' => ['Nonton Bioskop', 'Langganan Spotify', 'Game Online'],
            'Shopping'      => ['Beli Baju', 'Kebutuhan Rumah', 'Alat Tulis'],
        ];

        return [
            'type'        => $type,
            'amount'      => $amount,
            'category'    => $category,
            'description' => fake()->randomElement($descriptions[$category] ?? ['Transaksi']),
            'date'        => fake()->dateTimeBetween(
                now()->startOfMonth(),
                now()
            )->format('Y-m-d'),
        ];
    }

    /**
     * Configure the factory to produce only income transactions.
     */
    public function income(): static
    {
        return $this->state(function () {
            $category = fake()->randomElement(array_keys(self::INCOME_CATEGORIES));
            [$min, $max] = self::INCOME_CATEGORIES[$category];

            return [
                'type'     => 'income',
                'category' => $category,
                'amount'   => round(fake()->numberBetween($min, $max) / 1000) * 1000,
            ];
        });
    }

    /**
     * Configure the factory to produce only expense transactions.
     */
    public function expense(): static
    {
        return $this->state(function () {
            $category = fake()->randomElement(array_keys(self::EXPENSE_CATEGORIES));
            [$min, $max] = self::EXPENSE_CATEGORIES[$category];

            return [
                'type'     => 'expense',
                'category' => $category,
                'amount'   => round(fake()->numberBetween($min, $max) / 1000) * 1000,
            ];
        });
    }
}
