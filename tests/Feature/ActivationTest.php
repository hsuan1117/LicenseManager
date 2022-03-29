<?php

namespace Tests\Feature;

use Database\Seeders\Test\ActivationTestSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActivationTest extends TestCase {
    use DatabaseTransactions;

    protected function setUp(): void {
        $this->seed(ActivationTestSeeder::class);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_activation() {
        $response = $this->postJson('/api/', [
            'token' => '',
        ]);

        $response->assertStatus(200);
    }
}
