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
        Schema::table('todos', function (Blueprint $table) {
            $table->foreignId('task_priority_id')
                ->nullable()
                ->after('status')
                ->constrained('task_priorities')
                ->nullOnDelete();
        });

        $defaultPriorityMap = [];

        foreach (DB::table('users')->select('id')->orderBy('id')->cursor() as $user) {
            $priorities = DB::table('task_priorities')
                ->where('user_id', $user->id)
                ->pluck('id', 'name');

            $defaultPriorityMap[$user->id] = [
                'high' => $priorities['High'] ?? null,
                'medium' => $priorities['Medium'] ?? null,
                'low' => $priorities['Low'] ?? null,
            ];
        }

        DB::table('todos')
            ->select('id', 'user_id', 'priority')
            ->orderBy('id')
            ->chunkById(100, function ($todos) use ($defaultPriorityMap) {
                foreach ($todos as $todo) {
                    $priorityId = $defaultPriorityMap[$todo->user_id][strtolower($todo->priority)] ?? null;

                    if ($priorityId !== null) {
                        DB::table('todos')
                            ->where('id', $todo->id)
                            ->update(['task_priority_id' => $priorityId]);
                    }
                }
            });

        Schema::table('todos', function (Blueprint $table) {
            $table->dropColumn('priority');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium')->after('status');
        });

        DB::table('todos')
            ->select('todos.id', 'task_priorities.name')
            ->leftJoin('task_priorities', 'task_priorities.id', '=', 'todos.task_priority_id')
            ->orderBy('todos.id')
            ->chunkById(100, function ($todos) {
                foreach ($todos as $todo) {
                    $priority = match (strtolower($todo->name ?? '')) {
                        'high' => 'high',
                        'low' => 'low',
                        default => 'medium',
                    };

                    DB::table('todos')
                        ->where('id', $todo->id)
                        ->update(['priority' => $priority]);
                }
            }, 'todos.id');

        Schema::table('todos', function (Blueprint $table) {
            $table->dropConstrainedForeignId('task_priority_id');
        });
    }
};
