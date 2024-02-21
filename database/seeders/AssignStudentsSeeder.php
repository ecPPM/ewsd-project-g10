<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class AssignStudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve all users with a role_id of 3 (students)
        $students = User::where('role_id', 3)->get();

        // Prepare the data to be inserted
        $studentTutorData = $students->map(function ($student) {
            return [
                'student_id' => $student->id,
                'tutor_id' => null, // Assuming no tutor is assigned yet
                'is_current' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        })->toArray();

        // Insert data into the student_tutor table
        DB::table('student_tutor')->insert($studentTutorData);
    }
}
