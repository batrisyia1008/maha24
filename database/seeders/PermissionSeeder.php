<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'user-access',
            'user-create',
            'user-read',
            'user-update',
            'user-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate([
                'guard_name' => 'web',
                'name'       => $permission
            ]);
        }

        $admin = Role::where('name', 'admin')->first();

        foreach ($permissions as $permission){
            $admin->givePermissionTo($permission);
        }
    }
}
