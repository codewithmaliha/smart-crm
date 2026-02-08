<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_admin_dashboard()
    {
        $user = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Admin Dashboard');
    }

    public function test_staff_can_access_staff_dashboard()
    {
        $user = User::factory()->create(['role' => 'staff']);

        $response = $this->actingAs($user)->get('/staff/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Staff Dashboard');
    }

    public function test_student_can_access_student_dashboard()
    {
        $user = User::factory()->create(['role' => 'student']);

        $response = $this->actingAs($user)->get('/student/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Available Courses');
    }

    public function test_student_cannot_access_admin_dashboard()
    {
        $user = User::factory()->create(['role' => 'student']);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(403); // Unauthorized
    }

    public function test_staff_cannot_access_admin_dashboard()
    {
        $user = User::factory()->create(['role' => 'staff']);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(403); // Unauthorized
    }

    public function test_dashboard_redirects_correctly()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertRedirect(route('admin.dashboard'));

        $user = User::factory()->create(['role' => 'staff']);
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertRedirect(route('staff.dashboard'));

        $user = User::factory()->create(['role' => 'student']);
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertRedirect(route('student.dashboard'));
    }
}
