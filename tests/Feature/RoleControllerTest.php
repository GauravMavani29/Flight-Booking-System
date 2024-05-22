<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function it_displays_role_index_page()
    {
        $response = $this->get(route('admin.role.index'));
        $response->assertStatus(200);
    }

    public function it_creates_a_role()
    {
        $roleData = [
            'name' => 'editor',
            'guard_name' => 'web',
        ];

        $response = $this->post(route('admin.role.store'), $roleData);

        $response->assertRedirect(route('admin.role.index'));
        $this->assertDatabaseHas('roles', $roleData);
    }

    public function it_updates_a_role()
    {
        $role = Role::factory()->create();

        $updatedData = [
            'name' => 'manager',
            'guard_name' => 'web',
        ];

        $response = $this->put(route('admin.role.update', $role->id), $updatedData);

        $response->assertRedirect(route('admin.role.index'));
        $this->assertDatabaseHas('roles', $updatedData);
    }

    public function it_deletes_a_role()
    {
        $role = Role::factory()->create();

        $response = $this->delete(route('admin.role.destroy', $role->id));

        $response->assertRedirect(route('admin.role.index'));
        $this->assertDatabaseMissing('roles', ['id' => $role->id]);
    }
}
