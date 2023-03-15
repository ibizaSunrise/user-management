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

    public function testUserListAuth()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')
            ->getJson('/api/user');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'users' => [
                        '*' => [
                            'name',
                            'surname',
                            'email'
                        ]
                    ]
                ]
            ]);


    }


    public function testUserListWithoutAuth()
    {
        $response = $this->getJson('/api/user');

        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.'
            ]);
    }


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
            ->assertStatus(201)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'user' => [
                        'name',
                        'surname',
                        'email'
                    ]
                ]
            ]);

    }

    public function testStoreUserValidationError()
    {
        $user = User::factory()->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->actingAs($user, 'web')
            ->postJson('/api/user', $data);

        $response->assertStatus(422)
        ->assertJsonStructure([
            'errors'
        ]);
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
            ->assertStatus(201);

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
