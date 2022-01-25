<?php

namespace Tests\Feature\User;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Inertia\Testing\Assert;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;



class UpdateTest extends TestCase
{
    
    use RefreshDatabase;
    /** @test */
    public function testAUserNotAutenticatedCanNotUpdatedUser(){
        Role::create(['name' => 'Client']);
        $user = User::factory()->create()->assignRole('Client');
        $response = $this->get(route('users.edit',[$user]));
        $response->assertRedirect(route('login'));
        $response->assertStatus(302);
    }
    /** @test */
    public function testAUserClientAutenticatedCanNotUpdatedUser(){
        Role::create(['name' => 'Client']);
        $user1 = User::factory()->create()->assignRole('Client');
        $user2 = User::factory()->create()->assignRole('Client');
        $this->actingAs($user1);
        $response = $this->get(route('users.edit',[$user2]));
        $response->assertStatus(403);
        $response->assertSee('User does not have the right roles.');
    }
    /** @test */
    public function testAUserAdminAutenticatedCanSeeViewEditUser(){
        Role::create(['name' => 'Client']);
        Role::create(['name' => 'Admin']);
        $user1 = User::factory()->create()->assignRole('Admin');
        $user2 = User::factory()->create()->assignRole('Client');
        $this->actingAs($user1);
        $response = $this->get(route('users.edit',[$user2]));
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page)=> $page
            ->component('Users/edit')
            ->has('user', fn (Assert $page)=> $page
                ->where('first_name',$user2->first_name)
                ->etc()
            )
        );        
    }
    /** @test */
    public function testAUserAdminAutenticatedCanUpdatedUser(){
        Role::create(['name' => 'Client']);
        Role::create(['name' => 'Admin']);
        $user1 = User::factory()->create()->assignRole('Admin');
        $user2 = User::factory()->create()->assignRole('Client');
        $this->actingAs($user1);
        $response = $this->put(route('users.update',$user2),[
            'first_name' => 'pepito',
            'last_name' => 'perez',
            'telephone' => '1234567890',
            'active' => '0',
        ],[
            'first_name' ,
            'last_name' ,
            'telephone' ,
            'active'
        ]);
        $ddbb_User = User::where('id',$user2->id)->first();
        $this->assertEquals($ddbb_User['first_name'],'pepito');
        $this->assertEquals($ddbb_User['last_name'],'perez');
        $this->assertEquals($ddbb_User['telephone'],'1234567890');
        $this->assertEquals($ddbb_User['active'],'0');
        $response->assertRedirect(route('users.index'));
        $response->assertStatus(302);

    }
}
