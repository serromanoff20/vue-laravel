<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TMPTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testGuestNotSeeRequestList(): void
    {
        $this->assertGuest();

        $this->get(route("rent.requests.list"))
            ->assertStatus(302);
    }

    public function testAdminSeeRequestList()
    {
        $user = User::factory()->create([
            'password' => bcrypt('1234'),

        ]);

        $this->signIn($user);

        $this->get(route("rent.requests.list"))
            ->assertOk();
    }
}
