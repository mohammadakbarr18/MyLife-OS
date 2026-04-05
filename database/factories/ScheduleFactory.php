<?php

namespace Database\Factories;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    protected $model = Schedule::class;

    /**
     * Predefined daily activities with matching emojis and time windows.
     */
    private const ACTIVITIES = [
        ['title' => 'Morning Coffee',    'icon' => '☕', 'start' => '06:00', 'end' => '06:30'],
        ['title' => 'Olahraga Pagi',     'icon' => '🏃', 'start' => '06:30', 'end' => '07:30'],
        ['title' => 'Sarapan',           'icon' => '🍳', 'start' => '07:30', 'end' => '08:00'],
        ['title' => 'Coding Session',    'icon' => '💻', 'start' => '08:00', 'end' => '12:00'],
        ['title' => 'Makan Siang',       'icon' => '🍱', 'start' => '12:00', 'end' => '13:00'],
        ['title' => 'Meeting Tim',       'icon' => '📋', 'start' => '13:00', 'end' => '14:00'],
        ['title' => 'Deep Work',         'icon' => '🎯', 'start' => '14:00', 'end' => '16:00'],
        ['title' => 'Review & PR',       'icon' => '🔍', 'start' => '16:00', 'end' => '17:00'],
        ['title' => 'Istirahat',         'icon' => '😴', 'start' => '17:00', 'end' => '17:30'],
        ['title' => 'Belajar Hal Baru',  'icon' => '📚', 'start' => '19:00', 'end' => '20:00'],
        ['title' => 'Journaling',        'icon' => '✏️', 'start' => '21:00', 'end' => '21:30'],
        ['title' => 'Tidur',             'icon' => '🌙', 'start' => '22:00', 'end' => '06:00'],
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $activity = fake()->unique()->randomElement(self::ACTIVITIES);

        return [
            'title'      => $activity['title'],
            'icon'       => $activity['icon'],
            'start_time' => $activity['start'],
            'end_time'   => $activity['end'],
            'note'       => fake()->optional(0.4)->sentence(),
        ];
    }
}
