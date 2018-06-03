<?php

use App\HouseType;
use Illuminate\Database\Seeder;

class HouseTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Apartments', 'Houses', 'Commercials', 'Lots'];

        foreach ($types as $type) {
            HouseType::create([
                'type_name' => $type,
            ]);
        }
    }
}
