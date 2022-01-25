<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Product;
use Tests\TestCase;
use Inertia\Testing\Assert;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function testAUserNotAutenticatedCanListProducts()
    {
        $this->withoutExceptionHandling();
        $product = Product::factory(10)->create();
        $response = $this->get(route('products.index'));
        $response->assertInertia(fn (Assert $page)=> $page
            ->component('Product/index')
            ->has('products',10)
        );
        $response->assertStatus(200);
    }
}
