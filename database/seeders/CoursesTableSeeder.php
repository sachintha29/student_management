<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            ['name' => 'Mathematics'],
            ['name' => 'Physics'],
            ['name' => 'Chemistry'],
            ['name' => 'Biology'],
            ['name' => 'Computer Science'],
            ['name' => 'History'],
            ['name' => 'Geography'],
            ['name' => 'English Literature'],
            ['name' => 'Philosophy'],
            ['name' => 'Economics']
        ]);
    }
}
