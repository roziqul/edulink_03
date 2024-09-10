<?php

namespace Database\Seeders;

use App\Models\bookClassification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classifications = [
            ['id' => '1', 'name' => 'X'],
            ['id' => '2', 'name' => 'XI'],
            ['id' => '3', 'name' => 'XII'],
            ['id' => '4', 'name' => 'Umum'],
            ['id' => '5', 'name' => 'Guru'],
        ];        
    
        foreach ($classifications as $classification) {
            bookClassification::updateOrCreate(
                ['id' => $classification['id']],
                [
                    'name' => $classification['name'],
                ]
            );
        }
    }
}
