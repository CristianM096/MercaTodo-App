<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;
use Inertia\Testing\Assert;
use Spatie\Permission\Models\Role;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function testAUserNotAutenticatedCanNotListProducts()
    {
        //$this->withoutExceptionHandling();
        Product::factory(9)->create();
        $response = $this->get(route('products.show'));

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));/*
        $response->assertInertia(fn (Assert $page)=> $page
            ->component('Product/index')
            ->has('products', fn (Assert $page)=> $page
                ->where('total',9)
                ->where('last_page',2)
                ->has('data',5)
                ->etc()
            )
        );*/
    }
}
