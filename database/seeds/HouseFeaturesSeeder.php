<?php

use App\HouseFeature;
use Illuminate\Database\Seeder;

class HouseFeaturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $features = ['air conditioning', 'alarm', 'central heating',
                    'gym', 'internet', 'laundry room', 'swimming pool'];

        foreach ($features as $feature) {
            HouseFeature::create([
                'name' => $feature,
            ]);
        }

    }
}
