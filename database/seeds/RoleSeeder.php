<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = Role::create([
            'name' => 'Superadmin',
            'slug' => 'superadmin',
            'permissions' => [
                'show-house' => true,
                'show-featuredHouse' => true,
                'create-house' => true,
                'update-house' => true,
                'delete-house' => true,
                'approve-house' => true,
                'block-house' => true,
                'feature-house' => true,
                'unfeature-house' => true,
                'show-role' => true,
                'create-role' => true,
                'update-role' => true,
                'delete-role' => true,
                'show-user' => true,
                'create-user' => true,
                'update-user' => true,
                'delete-user' => true,
            ],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $admin = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'permissions' => [
                'show-house' => true,
                'show-featuredHouse' => true,
                'create-house' => true,
                'update-house' => true,
                'delete-house' => true,
                'approve-house' => true,
                'feature-house' => true,
                'unfeature-house' => true,
                'block-house' => true,
                'show-user' => true,
                'create-user' => true,
                'update-user' => true,
            ],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $host = Role::create([
            'name' => 'Host',
            'slug' => 'host',
            'permissions' => [
                'show-house' => true,
                'show-featuredHouse' => true,
                'create-house' => true,
                'update-house' => true,
                'delete-house' => true,
                'approve-house' => true,
                'block-house' => true,
            ],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $guest = Role::create([
            'name' => 'Guest',
            'slug' => 'guest',
            'permissions' => [
                'show-house' => true,
            ],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
