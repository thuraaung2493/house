<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $user = User::create([
            'name' => 'Thura Aung',
            'email' => 'thuraaung2493@gmail.com',
            'password' => bcrypt('myanmarlinks'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user->profile()->create([
            'address' => $faker->address,
            'phone_no' => $faker->phoneNumber,
        ]);

        $superadmin = Role::where('slug', 'superadmin')->get();

        $user->roles()->attach($superadmin);
    }
}
