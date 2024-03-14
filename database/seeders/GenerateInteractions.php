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
            ['name' => 'Assign Tutor'],  // 1

            ['name' => 'Create Meeting'],  // 2
            ['name' => 'Edit Meeting'],  // 3
            ['name' => 'Delete Meeting'],  // 4
            ['name' => 'Respond Meeting'],  // 5

            ['name' => 'Add Meeting Note'],  // 6
            ['name' => 'Edit Meeting Note'],  // 7
            ['name' => 'Delete Meeting Note'],  // 8

            ['name' => 'Add Post'],  // 9
            ['name' => 'Edit Post'],  // 10
            ['name' => 'Delete Post'],  // 11

            ['name' => 'Add Comment'],  // 12
            ['name' => 'Edit Comment'],  // 13
            ['name' => 'Delete Comment'],  // 14

            ['name' => 'Add File'],  // 15
            ['name' => 'Delete File'],  // 16

            ['name' => 'Send Message'],  // 17
        ]);
    }
}
