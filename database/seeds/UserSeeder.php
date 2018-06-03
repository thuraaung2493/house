<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $hostUser = User::create([
            'name' => 'Zaw Zaw',
            'email' => 'zaw@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        $hostUser->profile()->create([
            'address' => $faker->address,
            'phone_no' => $faker->phoneNumber,
        ]);

        $host = Role::where('slug', 'host')->get();

        $hostUser->roles()->attach($host);

        $guestUser = User::create([
            'name' => 'Aung Aung',
            'email' => 'aung@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        $guestUser->profile()->create([
            'address' => $faker->address,
            'phone_no' => $faker->phoneNumber,
        ]);

        $guest = Role::where('slug', 'guest')->get();

        $guestUser->roles()->attach($guest);

    }
}
