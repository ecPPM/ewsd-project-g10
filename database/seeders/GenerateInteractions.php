<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class GenerateInteractions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('interactions')->insert([
            ['name' => 'Assign Tutor'],

            ['name' => 'Create Meeting'],
            ['name' => 'Edit Meeting'],
            ['name' => 'Delete Meeting'],
            ['name' => 'Respond Meeting'],

            ['name' => 'Add Meeting Note'],
            ['name' => 'Edit Meeting Note'],
            ['name' => 'Delete Meeting Note'],

            ['name' => 'Add Post'],
            ['name' => 'Edit Post'],
            ['name' => 'Delete Post'],

            ['name' => 'Add Comment'],
            ['name' => 'Edit Comment'],
            ['name' => 'Delete Comment'],

            ['name' => 'Add File'],
            ['name' => 'Delete File'],

            ['name' => 'Send Message'],
        ]);
    }
}
