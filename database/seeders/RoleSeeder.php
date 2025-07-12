<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'Role' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Role' => 'rektor',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Role' => 'warek',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Role' => 'sekretarisrektor',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Role' => 'Unit',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
