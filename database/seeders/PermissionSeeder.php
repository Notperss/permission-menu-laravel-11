<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'general',
            'setting',

            // Dashboard
            'dashboard_index',

            // General Settings
            'setting_index',
            'setting_update',

            // User Management
            'user_index',
            'user_store',
            'user_update',
            'user_destroy',
            'profile_index',

            // Menu Management
            'menu_index',
            'menu_store',
            'menu_update',
            'menu_destroy',
            'menu_item_index',
            'menu_item_store',
            'menu_item_update',
            'menu_item_destroy',

            // Route Management
            'route_index',
            'route_store',
            'route_update',
            'route_destroy',

            // Role Management
            'role_index',
            'role_store',
            'role_update',
            'role_destroy',

            // Permission Management
            'permission_index',
            'permission_store',
            'permission_update',
            'permission_destroy',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

    }
}
