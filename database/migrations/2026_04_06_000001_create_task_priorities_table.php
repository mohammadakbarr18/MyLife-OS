<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('task_priorities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('color', 7);
            $table->timestamps();

            $table->unique(['user_id', 'name']);
        });

        $now = now();

        foreach (DB::table('users')->select('id')->orderBy('id')->cursor() as $user) {
            foreach ([
                ['name' => 'High', 'color' => '#DC2626'],
                ['name' => 'Medium', 'color' => '#D97706'],
                ['name' => 'Low', 'color' => '#2563EB'],
            ] as $priority) {
                DB::table('task_priorities')->insert([
                    'user_id' => $user->id,
                    'name' => $priority['name'],
                    'color' => $priority['color'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_priorities');
    }
};
