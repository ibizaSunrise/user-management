<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{

    use WithFaker;

    public function test_a_basic_request()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
            //todo: assertJson
//            ->assertJson([
//            'success' => false
//        ]);;
    }


//    public function testUserListWithoutAuth()
//    {
//        $user = User::factory()->create();
////todo: test without guard
//        $response = $this->actingAs($user, null)
//            ->getJson('/user');
//
//        $response
//            ->assertStatus(403)
//            ->assertJson([
//                'success' => false
//            ]);
//    }
//

    public function testStoreUser()
    {
        $user = User::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'surname' => $this->faker->lastName,
            'email' => $this->faker->email,
            'password' => Hash::make('123123'),

        ];

        $response = $this->actingAs($user, 'web')
            ->postJson('/api/user', $data);

        $response
            ->assertStatus(201);

    }

    public function testStoreUserValidationError()
    {
        $user = User::factory()->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->actingAs($user, 'web')
            ->postJson('/api/user', $data);

        $response->assertStatus(422);
    }

    public function testUpdateUser()
    {
        $user = User::factory()->create();

        $data = [
            'id' => $user->id,
            'name' => $this->faker->name,
            'surname' => $user->surname,
            'email' => $this->faker->email,
            'password' => Hash::make($this->faker->password(8)),
        ];

        $response = $this->actingAs($user, 'web')
            ->putJson('/api/user/' . $user->id, $data);
        $response
            ->assertStatus(200);

    }


    public function testUpdateUserValidationError()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')
            ->putJson('/api/user/' . $user->id, ['email' => 'Invalid@email com']);

        $response->assertStatus(422);
    }



    public function testDeleteUser()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')
            ->deleteJson('/api/user/' . $user->id);

        $response->assertStatus(204);

    }


}
