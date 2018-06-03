<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(HouseFeaturesSeeder::class);
        $this->call(HouseTypesSeeder::class);
        $this->call(RegionsSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(SuperAdminSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(HousesSeeder::class);
    }
}
