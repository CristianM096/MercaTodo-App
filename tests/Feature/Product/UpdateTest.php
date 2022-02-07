<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testAUserNotAutenticatedCanNotUpdateProduct(){
        //$this->withoutExceptionHandling();
        $product = Product::factory()->create();
        $prod = $this->productData();
        $response = $this->put(route('users.update',$product),$prod,[
            'name' ,
            'price' ,
            'photo' ,
            'description' ,
            'stock' ,
            'color' ,
            'weight' ,
            'size' ,
        ]);
        $response->assertRedirect(route('login'));
        $response->assertStatus(302);
    }

    public function testAUserClientAutenticatedCanNotUpdateProduct(){
        Role::create(['name' => 'Client']);
        $user = User::factory()->create()->assignRole('Client');
        $this->actingAs($user);
        $product = Product::factory()->create();
        $prod = $this->productData();
        $response = $this->put(route('users.update',$product),$prod,[
            'name' ,
            'price' ,
            'photo' ,
            'description' ,
            'stock' ,
            'color' ,
            'weight' ,
            'size' ,
        ]);
        $response->assertStatus(403);
        $response->assertSee('User does not have the right roles.');
    }

    public function testAUserAdminAutenticatedCanUpdateProduct(){
        Role::create(['name' => 'Admin']);
        $user = User::factory()->create()->assignRole('Admin');
        $this->actingAs($user);
        $product = Product::factory()->create();
        $prod = $this->productData();
        $response = $this->put(route('products.update',$product),$prod,[
            'name' ,
            'price' ,
            'photo' ,
            'description' ,
            'stock' ,
            'color' ,
            'weight' ,
            'size' ,
            'active'
        ]);
        $ddbb_Product = Product::where('id',$product->id)->first();
        $this->assertEquals($ddbb_Product->name,$prod['name']);
        $this->assertEquals($ddbb_Product->description,$prod['description']);
        $this->assertEquals($ddbb_Product->price,$prod['price']);
        $response->assertRedirect(route('products.index'));
        $response->assertStatus(302);
    }

    private function productData(): array
    {
        return [
            'name' => 'cerveza',
            'price' => 12345,
            'photo' => UploadedFile::fake()->image('product.jpg', 500, 250)->size(50),
            'description' => $this->faker->text(50),
            'stock' => 4,
            'color' => 'blue',
            'weight' => 6,
            'size' => 'big',
            'active' => true
        ];
    }
}
