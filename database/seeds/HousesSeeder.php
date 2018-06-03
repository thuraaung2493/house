<?php

use App\House;
use Illuminate\Database\Seeder;

class HousesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $features = ['air conditioning', 'alarm', 'central heating', 'gym', 'internet', 'laundry room', 'swimming pool'];
        $str_features = implode(', ', $faker->randomElements($features, $count = 3));
        $streets = ['Thein Gyi St.,', 'Yadana St.,', 'Padauk Pin St.,'];
        $townships = ['Kyimyindine', 'Ahlone', 'Kamayut', 'Botadaung'];
        $period = ['month', 'year'];
        $rooms = ['1', '2', '3', '4', 'more-than-5'];

        for ($i = 0; $i <= 30; $i++) {
            //house basic
            $house = House::create([
                'user_id' => $faker->numberBetween($min = 1, $max = 6),
                'title' => title_case($faker->sentence($nbWords = 2, $variableNbWords = true)),
                'house_type_id' => $faker->numberBetween($min = 1, $max = 4),
                'period' => array_random($period),
                'price' => $faker->numberBetween($min = 100000, $max = 900000),
                'area' => $faker->numberBetween($min = 500, $max = 1000),
                'rooms' => array_random($rooms),
                'description' => $faker->text($maxNbChars = 200),
                'features' => $str_features,
            ]);

            $house_id = $house->id;

            //house details
            $house->houseDetail()->create([
                'building_year' => $faker->numberBetween($min = 1999, $max = 2019),
                'bathrooms' => $faker->numberBetween($min = 1, $max = 4),
                'bedrooms' => $faker->numberBetween($min = 1, $max = 4),
                'parking' => $faker->boolean,
                'water' => $faker->boolean,
                'exercise_room' => $faker->boolean,
            ]);

             // save to database (galleries)
            $house->galleries()->create([
                'image_name' => $house_id . "-feature-house",
                'extension' => "jpeg",
                'is_featured' => true,
            ]);

            for ($ii=1; $ii < 4; $ii++) {
                $house->galleries()->create([
                    'image_name' => $house_id . "house-" . $ii,
                    'extension' => "jpeg",
                ]);
            }
            $street = array_random($streets);
            $township = array_random($townships);
            $address = "No.1, " . $street . $township;
            //locations
            $house->location()->create([
                'address' => $address,
                'street' => $street,
                'township' => $township,
                'region_id' => $faker->numberBetween($min = 1, $max = 4),
            ]);
            $address = "No.1," . $street . $township . ", " . $house->location->region->name;

            $house->location()->update([
                'address' => $address,
            ]);
        }
    }
}
