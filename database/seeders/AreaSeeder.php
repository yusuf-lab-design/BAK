<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Area;
use DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $areas = [ 
            
        ];
        DB::table('areas')->insert([
            ['code' => '001022', 'name' => 'Padang'],
            ['code' => '002000', 'name' => 'Batam']
        ]);
    }
}
