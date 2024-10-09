<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define the permissions array
        $permissions = [
            'roles' => [
                'view-roles',
                'create-roles',
                'edit-roles',
                'delete-roles',
            ],
            'categories' => [
                'view-categories',
                'create-categories',
                'edit-categories',
                'delete-categories',
            ],
            'users' => [
                'view-users',
                'create-users',
                'edit-users',
                'delete-users',
            ],
            'documents' => [
                'view-documents',
                'create-documents',
                'edit-documents',
                'delete-documents',
            ],
            // Add more modules and permissions as needed
        ];

        // Iterate through the permissions array and create permissions
        foreach ($permissions as $module => $perms) {
            foreach ($perms as $permission) {
                Permission::firstOrCreate(['name' => $permission]);
            }
        }

        // Create roles and assign existing permissions

        // Super Admin - has all permissions
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo(Permission::all());
    }
}
