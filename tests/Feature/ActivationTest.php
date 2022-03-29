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

    public function test_activation() {
        $response = $this->postJson('/api/activate', [
            'token' => 'TEST_TOKEN',
            'activated_ip' => 'Linux',
            'activated_uname' => 'test',
            'activated_cpu' => 'Intel'
        ]);

        $response->assertStatus(200);
    }

    public function test_activation_exceed() {
        $this->postJson('/api/activate', [
            'token' => 'TEST_TOKEN',
            'activated_uname' => 'test',
            'activated_cpu' => 'Intel'
        ])->assertStatus(200);

        $this->postJson('/api/activate', [
            'token' => 'TEST_TOKEN',
            'activated_uname' => 'test2',
            'activated_cpu' => 'Intel'
        ])->assertStatus(200);

        $this->postJson('/api/activate', [
            'token' => 'TEST_TOKEN',
            'activated_uname' => 'test3',
            'activated_cpu' => 'Intel'
        ])->assertStatus(403);
    }
}
