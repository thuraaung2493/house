<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $user1 = User::create([
            'name' => 'Min Kaung Htet',
            'email' => 'minkaunghtet@gmail.com',
            'password' => bcrypt('wpa281'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user1->profile()->create([
            'address' => $faker->address,
            'phone_no' => $faker->phoneNumber,
        ]);

        $user2 = User::create([
            'name' => 'Nay Lin Ko',
            'email' => 'naylinko@gmail.com',
            'password' => bcrypt('wpa282'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user2->profile()->create([
            'address' => $faker->address,
            'phone_no' => $faker->phoneNumber,
        ]);

        $user3 = User::create([
            'name' => 'Mya Pwint Yadanar',
            'email' => 'myapwint@gmail.com',
            'password' => bcrypt('wpa283'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user3->profile()->create([
            'address' => $faker->address,
            'phone_no' => $faker->phoneNumber,
        ]);

        $user4 = User::create([
            'name' => 'Pyae Phyo Oo',
            'email' => 'pyaephyooo@gmail.com',
            'password' => bcrypt('wpa284'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user4->profile()->create([
            'address' => $faker->address,
            'phone_no' => $faker->phoneNumber,
        ]);

        $admin = Role::where('slug', 'admin')->get();

        $user1->roles()->attach($admin);
        $user2->roles()->attach($admin);
        $user3->roles()->attach($admin);
        $user4->roles()->attach($admin);
    }
}
