<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ActivationTestSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $project = Project::create([
            'name' => 'test'
        ]);
        $project->codes()->create([
            'title' => 'print_function',
            'language' => 'python',
            'content' => base64_encode(<<<EOF
                def a(x):
                    print(x)
            EOF
            )
        ]);
        $project->tokens()->create([
            'name' => '測試用金鑰',
            'content' => 'TEST_TOKEN'
        ]);

        $project->tokens()->create([
            'name' => '測試用金鑰2',
            'content' => 'TEST_TOKEN_LIMIT',
            'activated_limit' => 2
        ]);
    }
}
