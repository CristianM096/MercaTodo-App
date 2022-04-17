<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class EditTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    public function testAUserNotAutenticatedCanNotSeeViewEditProduct()
    {
        $product = Product::factory()->create();
        $response = $this->get(route('products.edit', [$product]));
        $response->assertRedirect(route('login'));
        $response->assertStatus(302);
    }

    public function testAUserClientAutenticatedCanNotSeeViewEditProduct()
    {
        Role::create(['name' => 'Client']);
        $user = User::factory()->create()->assignRole('Client');
        $product = Product::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('products.edit', [$product]));
        $response->assertStatus(403);
        $response->assertSee('User does not have the right roles.');
    }
    public function testAUserClientAutenticatedCanSeeViewEditProduct()
    {
        Role::create(['name' => 'Admin']);
        $user = User::factory()->create()->assignRole('Admin');
        $product = Product::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('products.edit', [$product]));
        $response->assertStatus(200);
    }
}
