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
            // menu
            'menu.main-menu',
            'menu.role-permission',
            'menu.access-management',

            // Dashboard
            'dashboard.index',

            // General Settings
            // 'setting.index',
            // 'setting.update',

            // User Management
            'user.index',
            'user.store',
            'user.update',
            'user.destroy',
            'profile.index',

            // Menu Management
            'menu-group.index',
            'menu-group.store',
            'menu-group.update',
            'menu-group.destroy',
            //menu-item
            'menu-item.index',
            'menu-item.store',
            'menu-item.update',
            'menu-item.destroy',

            // Route Management
            'route.index',
            'route.store',
            'route.update',
            'route.destroy',

            // Role Management
            'role.index',
            'role.store',
            'role.update',
            'role.destroy',

            // Permission Management
            'permission.index',
            'permission.store',
            'permission.update',
            'permission.destroy',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

    }
}
