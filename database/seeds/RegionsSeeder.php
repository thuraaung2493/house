<?php

use App\Region;
use Illuminate\Database\Seeder;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = ['Yangon', 'Mandalay', 'Nay Pyi Taw', 'Pyi Oo Lwin'];

        foreach ($regions as $region) {
            Region::create([
                'name' => $region,
            ]);
        }
    }
}
