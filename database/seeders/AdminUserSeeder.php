<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Division;
use Illuminate\Support\Facades\Hash;


class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $divisionCodes = [
            'Finance' => 'fin',
            'Accounting' => 'act',
            'Operation' => 'anc',
            'IT' => 'isa',
            'Sales' => 'sls',
        ];

        $divisions = Division::all();

        foreach ($divisions as $division) {
            $code = $divisionCodes[$division->name] ?? 'xxx';

            for ($i =1; $i <= 4; $i++) {
                $userid = '000'. $code . str_pad($i, 2, '0', STR_PAD_LEFT);

                $user = User::create([
                    'name' => $division->name . 'User ' . $i,
                    'email' => $code . $i . '@example.com',
                    'password' => Hash::make('121314qw'),
                    'role' => $i === 1 ? 'ho' : 'area',
                    'level' => 'head',
                    'division_id' => $division->id,
                    'userid' => $userid,
                ]);

                if ($i === 1) {
                    $division->head_user_id = $user->id;
                    $division->save();
                }
            }
        }
    }
}
