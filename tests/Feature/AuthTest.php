<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
class AuthTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function user_can_register()
    {
        $response = $this->post('/register', [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password'
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticated();
    }
    /**
     * @test
     */
    public function user_can_login()
    {
        $user = User::factory()->create([
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password')
        ]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }
}
