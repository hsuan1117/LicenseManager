<?php

namespace Database\Seeders\Test;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'language' => 'python',
            'content' => base64_encode(<<<EOF
                def a(x):
                    print(x)
            EOF
            )
        ]);
        $token = $project->tokens()->create([
           'content' => 'TEST_TOKEN'
        ]);
    }
}
