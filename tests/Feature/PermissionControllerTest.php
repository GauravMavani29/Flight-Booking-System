<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\User;
use Tests\TestCase;

class PermissionControllerTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function it_displays_permission_index_page()
    {
        $response = $this->get(route('admin.permission.index'));
        $response->assertStatus(200);
    }

    public function it_creates_a_permission()
    {
        $permissionData = [
            'name' => 'edit articles',
            'section' => 'edit articles',
            'guard_name' => 'web',
        ];

        $response = $this->post(route('admin.permission.store'), $permissionData);

        $response->assertRedirect(route('admin.permission.index'));
        $this->assertDatabaseHas('permissions', $permissionData);
    }

    public function it_updates_a_permission()
    {
        $permission = Permission::factory()->create();

        $updatedData = [
            'name' => 'edit posts',
            'section' => 'edit posts',
            'guard_name' => 'web',
        ];

        $response = $this->put(route('admin.permission.update', $permission->id), $updatedData);

        $response->assertRedirect(route('admin.permission.index'));
        $this->assertDatabaseHas('permissions', $updatedData);
    }

    /** @test */
    public function it_deletes_a_permission()
    {
        $permission = Permission::factory()->create();

        $response = $this->delete(route('admin.permission.destroy', $permission->id));

        $response->assertRedirect(route('admin.permission.index'));
        $this->assertDatabaseMissing('permissions', ['id' => $permission->id]);
    }
}
