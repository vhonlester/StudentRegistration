<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'name' => 'Computer Science A',
                'code' => 'CS-A',
                'description' => 'Advanced Computer Science Section',
                'capacity' => 30
            ],
            [
                'name' => 'Computer Science B',
                'code' => 'CS-B',
                'description' => 'Intermediate Computer Science Section',
                'capacity' => 25
            ],
            [
                'name' => 'Information Technology',
                'code' => 'IT-01',
                'description' => 'Information Technology Fundamentals',
                'capacity' => 35
            ],
            [
                'name' => 'Software Engineering',
                'code' => 'SE-01',
                'description' => 'Software Engineering Principles',
                'capacity' => 20
            ],
            [
                'name' => 'Data Science',
                'code' => 'DS-01',
                'description' => 'Data Science and Analytics',
                'capacity' => 25
            ]
        ];

        foreach ($sections as $section) {
            Section::create($section);
        }
    }
}
