<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_admin_user_cannot_access_admin_dashboard(): void
    {
        $user = User::factory()->create([
            'email' => 'editor@example.com',
        ]);

        $this->actingAs($user);

        $response = $this->get('/admin');

        $response->assertForbidden();
    }
}
