<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthTest extends TestCase
{

    use DatabaseTransactions;

    public function testLogin() {
        $user = User::factory()->createOne();

        $response = $this->post(
            '/api/auth/login',
            [
             'username' => $user->username,
             'password' => 'password',
            ]
        );

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in',
            'user' => [
                'id',
                'username',
                'email',                
                'created_at',
                'updated_at',
            ],            
        ]);
        
        JWTAuth::setToken($response->json('access_token'))->checkOrFail();
    }

    public function testRegister() {

        $user = User::factory()->makeOne();

        $response = $this->post(
            '/api/auth/register',
            [
                'username' => $user->username,
                'email' => $user->email,
                'dob' => Carbon::parse($user->dob)->format('Y-m-d'),
                'password' => 'password',
                'password_confirmation' => 'password',
            ],
        );

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'message',
            'user' => [
                'id',
                'username',
                'email',                
                'dob',   
                'created_at',
                'updated_at',
            ],            
        ]);
    }

    public function testLogout() {
        $user = User::factory()->createOne();
        $token = JWTAuth::fromUser($user);  
        $response = $this->post('/api/auth/logout', [], [
            'Authorization' => "Bearer $token",
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure(['message']);        
        $this->assertFalse(JWTAuth::setToken($token)->check());
    }

    public function testGetProfile() {
        $user = User::factory()->createOne();
        $token = JWTAuth::fromUser($user);

        $response = $this->get('/api/auth/user-profile', [
            'Authorization' => "Bearer $token",
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'id'=> $user->id,
            'username'=> $user->username,
            'email'=> $user->email,
            'dob' => $user->dob->toISOString(),
            'created_at'=> $user->created_at->toISOString(),
            'updated_at'=> $user->updated_at->toISOString(),
        ]);
    }
}
