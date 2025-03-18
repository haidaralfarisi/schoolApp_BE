<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schools = [
            [
                'school_name' => 'KB Islam Dian Didaktika',
                'school_id' => 'CNKB',
                'region' => 'Jakarta',
                'address' => 'Jl. Raya Cipinang Jaya No. 1',
                'email' => 'info@diandidaktika.sch.id',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        School::insert($schools);
    }
}
