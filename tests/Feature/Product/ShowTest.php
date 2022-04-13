<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\Assert;
use Inertia\Testing\Assert as TestingAssert;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;
    public function testAUserClientAutenticatedCanListProducts()
    {
        $this->withoutExceptionHandling();
        Product::factory(15)->create();
        Role::create(['name' => 'Client']);
        $user = User::factory()->create()->assignRole('Client');
        $this->actingAs($user);
        $response = $this->get(route('products.show'));

        $response->assertInertia(
            fn (Assert $page) => $page
            ->component('Product/indexClient')
            ->has(
                'products',
                fn (Assert $page) => $page
                ->where('total', 15)
                ->where('last_page', 2)
                ->has('data', 12)
                ->etc()
            )
        );
    }
}
