<?php

use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        Role::create([
            'role_name' => 'admin'
        ]);

        Role::create([
            'role_name' => 'chief'
        ]);

        Role::create([
            'role_name' => 'pm'
        ]);

        Role::create([
            'role_name' => 'member'
        ]);
    }
}
