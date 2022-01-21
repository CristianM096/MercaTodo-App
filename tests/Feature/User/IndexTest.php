<?php

namespace Tests\Feature\User;

use App\Models\User;
use Spatie\Permission\Models\Role;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use SebastianBergmann\Type\TypeName;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function testAUserNotAutenticatedNotCanListUsers()
    {
        $response = $this->get(route('users.index'));
        $response->assertRedirect(route('login'));
        $response->assertStatus(302);
    }
    public function testAUserClientAutenticatedNotCanListUsers()
    {
        Role::create(['name' => 'Client']);
        $user = User::factory()->create()->assignRole('Client');
        $this->actingAs($user);
        $response = $this->get(route('users.index'));
        $response->assertStatus(403);
        $response->assertSee('User does not have the right roles.');
    }
    public function testAUserAdminAutenticatedCanListUsers()
    {
        $this->withoutExceptionHandling();
        Role::create(['name' => 'Admin']);
        $user = User::factory()->create()->assignRole('Admin');
        User::factory(10)->create();
        $this->actingAs($user);
        $response = $this->get(route('users.index'));
        $response->assertStatus(200);
        $content = $response->getOriginalContent();
        $users = $content['page']['props']['users'];
        $this->assertEquals($user->id,$users[0]['id']);
        $this->assertEquals(count($users),11);
    }
}
