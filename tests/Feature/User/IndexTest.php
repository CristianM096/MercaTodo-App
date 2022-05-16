<?php

namespace Tests\Feature\User;

use App\Models\User;
use Spatie\Permission\Models\Role;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\Assert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use SebastianBergmann\Type\TypeName;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function testAUserNotAutenticatedCanNotListUsers()
    {
        $response = $this->get(route('users.index'));
        $response->assertRedirect(route('login'));
        $response->assertStatus(302);
    }
    /** @test */
    public function testAUserClientAutenticatedCanNotListUsers()
    {
        Role::create(['name' => 'Client']);
        $user = User::factory()->create()->assignRole('Client');
        $this->actingAs($user);
        $response = $this->get(route('users.index'));
        $response->assertStatus(403);
        $response->assertSee('User does not have the right roles.');
    }
    /** @test */
    public function testAUserAdminAutenticatedCanListUsers()
    {
        $this->withoutExceptionHandling();
        Role::create(['name' => 'Admin']);
        $user = User::factory()->create([
            'first_name' => 'cristian',
            'last_name' => 'manzano',
            'email' => 'cristian@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ])->assignRole('Admin');

        $users = User::factory(10)->create();
        $this->actingAs($user);
        $response = $this->get(route('users.index'));
        $response->assertStatus(200);
        $content = $response->getOriginalContent();

        $response->assertInertia(
            fn (Assert $page) => $page
            ->component('Users/index')
            ->has(
                'users',
                11,
                fn (Assert $page) => $page
                ->whereAll([
                    'id' => 1,
                    'nid' => null,
                    'first_name' => 'cristian',
                    'last_name' => 'manzano',
                    'active' => '1',
                    'telephone' => null,
                    'email' => 'cristian@gmail.com',
                ])
                ->etc()
                ->missing('password')
            )
        );

        $users = $content['page']['props']['users'];
        $this->assertEquals($user->id, $users[0]['id']);
        $this->assertEquals(count($users), 11);
    }
}
