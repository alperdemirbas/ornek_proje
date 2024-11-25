<?php

namespace Rezyon\Locations\Databases\Seeds;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Rezyon\Locations\Models\District;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districtList = file_get_contents(__DIR__ . '/../../resources/district.json');
        $jsonList = json_decode($districtList);
        foreach ($jsonList as $item){
            District::query()->create([
                'id' => $item->ilce_id,
                'city_id' => $item->il_id,
                'district_name' => $item->ilce_adi,
            ]);
        }

    }
}
