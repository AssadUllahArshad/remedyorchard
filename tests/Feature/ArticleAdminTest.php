<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ArticleAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_user_can_view_article_creation_page(): void
    {
        Role::create(['name' => 'admin']);

        $user = User::factory()->create();
        $user->assignRole('admin');
        Category::create([
            'name' => 'Health',
            'slug' => 'health',
            'icon' => 'bi-heart-fill',
            'description' => 'Health topics',
        ]);

        $this->actingAs($user);

        $response = $this->get('/admin/articles/create');

        $response->assertOk();
    }
}
