<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ActivationTest extends TestCase {
    use DatabaseTransactions;

    protected function setUp(): void {
        parent::setUp();
        $this->seed('Database\\Seeders\\ActivationTestSeeder');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_activation() {
        $response = $this->postJson('/api/', [
            'token' => 'TEST_TOKEN',
        ]);

        $response->assertStatus(200);
    }
}
