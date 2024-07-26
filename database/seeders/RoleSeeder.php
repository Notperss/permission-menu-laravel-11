<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        Model::unguard();

        $superadmin = Role::create(['name' => 'super-admin',]);
        $user = Role::create(['name' => 'user']);

        $makeSuperAdmin = User::factory()->create([
            'name' => 'super-admin',
            'avatar' => 'images/default-avatar.png',
            'email' => 'super@admin.com',
        ]);
        $makeUser = User::factory()->create([
            'name' => 'user',
            'avatar' => 'images/default-avatar.png',
            'email' => 'user@user.com',
        ]);

        $makeSuperAdmin->assignRole($superadmin);
        $makeUser->assignRole($user);
    }
}







