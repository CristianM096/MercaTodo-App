<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use Inertia\Testing\Assert;
use Illuminate\Http\UploadedFile;
use Spatie\Permission\Models\Role;

class CreateTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    public function testAUserNotAutenticatedCanNotSeeViewCreateProduct()
    {
        $response = $this->get(route('productsClient.index'));
        $response->assertRedirect(route('login'));
        $response->assertStatus(302);
    }
    public function testAUserClientAutenticatedCanNotSeeViewCreateProduct()
    {
        Role::create(['name' => 'Client']);
        $user = User::factory()->create()->assignRole('Client');
        $this->actingAs($user);
        $response = $this->get(route('products.create'));
        $response->assertStatus(403);
        $response->assertSee('User does not have the right roles.');
    }
    public function testAUserClientAutenticatedCanNotCreateProduct()
    {
        Role::create(['name' => 'Client']);
        $user = User::factory()->create()->assignRole('Client');
        $product = $this->productData();
        $this->actingAs($user);
        $response = $this->post(route('products.store', $product));
        $response->assertStatus(403);
        $response->assertSee('User does not have the right roles.');
    }
    public function testAUserAdminAutenticatedCanSeeViewCreateProduct()
    {
        Role::create(['name' => 'Admin']);
        $user = User::factory()->create()->assignRole('Admin');
        $this->actingAs($user);
        $response = $this->get(route('products.create'));
        $response->assertStatus(200);
    }
    public function testAUserAdminAutenticatedCanCreateProduct()
    {
        //$this->withoutExceptionHandling();
        Role::create(['name' => 'Admin']);
        $user = User::factory()->create()->assignRole('Admin');
        $product = $this->productData();
        //dd($product);
        $this->actingAs($user);
        $response = $this->post(route('products.store'), $product);
        //dd($response);
        $ddbb_Product = Product::where('name', $product['name'])->first();
        $this->assertDatabaseCount('products', 1);
        $response->assertStatus(302);
        $response->assertRedirect(route('products.index'));
    }
    private function productData(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'price' => $this->faker->randomNumber(5),
            'photo' => $this->faker->image('public/storage/productImages', 400, 300),
            'discount' => 0,
            'description' => $this->faker->text(100),
            'stock' => $this->faker->randomNumber(5, 20),
            'color' => $this->faker->colorName(),
            'weight' => $this->faker->randomFloat(2, 0, 9999),
            'size' => $this->faker->word(),
            'active' => true,
        ];
    }
}
