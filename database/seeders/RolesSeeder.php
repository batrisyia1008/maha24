<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        Permission::truncate();
        Role::truncate();
        Schema::enableForeignKeyConstraints();

        $roles =[
            [
                'name'       => 'admin',
                'guard_name' => 'web',
            ],
        ];

        foreach ($roles as $role){
            Role::create([
                'guard_name' => $role['guard_name'],
                'name'       => $role['name'],
            ]);
        }
    }
}
