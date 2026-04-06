<?php

namespace Tests\Feature;

use App\Models\TaskPriority;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskPriorityFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_settings_page_displays_the_task_priority_section(): void
    {
        $user = User::factory()->create();
        TaskPriority::ensureDefaultsForUser($user);

        $response = $this->actingAs($user)->get(route('settings.index'));

        $response->assertOk();
        $response->assertSee('Prioritas To-Do List');
        $response->assertSee('High');
    }

    public function test_user_can_create_a_todo_with_an_owned_task_priority(): void
    {
        $user = User::factory()->create();
        TaskPriority::ensureDefaultsForUser($user);
        $priority = $user->taskPriorities()->firstOrFail();

        $response = $this->actingAs($user)->post(route('todo.store'), [
            'title' => 'Kerjakan presentasi sprint',
            'task_priority_id' => $priority->id,
            'due_date' => '2026-04-10',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('todos', [
            'user_id' => $user->id,
            'title' => 'Kerjakan presentasi sprint',
            'task_priority_id' => $priority->id,
        ]);
    }

    public function test_user_cannot_create_a_todo_with_someone_elses_task_priority(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        TaskPriority::ensureDefaultsForUser($user);
        TaskPriority::ensureDefaultsForUser($otherUser);

        $foreignPriority = $otherUser->taskPriorities()->firstOrFail();

        $response = $this->actingAs($user)->from(route('todo'))->post(route('todo.store'), [
            'title' => 'Tugas invalid',
            'task_priority_id' => $foreignPriority->id,
            'due_date' => null,
        ]);

        $response->assertRedirect(route('todo'));
        $response->assertSessionHasErrors('task_priority_id');
        $this->assertDatabaseMissing('todos', [
            'user_id' => $user->id,
            'title' => 'Tugas invalid',
        ]);
    }
}
