<?php

namespace Rezyon\Locations\Databases\Seeds;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Rezyon\Locations\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cityList = file_get_contents(__DIR__ . '/../../resources/city.json');
        $jsonList = json_decode($cityList);

        foreach ($jsonList as $item){
            City::query()->create([
                'city_id' => $item->il_id,
                'city_name' => $item->il_adi,
            ]);
        }
    }
}
