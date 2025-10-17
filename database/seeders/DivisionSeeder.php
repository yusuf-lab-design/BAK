<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Division;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = [
            'Accounting',
            'Finance',
            'Operation',
            'IT',
            'Sales'
        ];

        foreach ($divisions as $name) {
            Division::Create([
                'name' => $name,
                'head_user_id' => null,
                'is_active' => true,
            ]);
        }
    }
}
