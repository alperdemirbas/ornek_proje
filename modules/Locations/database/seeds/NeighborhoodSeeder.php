<?php

namespace Rezyon\Locations\Databases\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Rezyon\Locations\Models\Neighborhood;

class NeighborhoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $neighborhoodList = file_get_contents(__DIR__ . '/../../resources/neighborhood.json');
        $jsonList = json_decode($neighborhoodList);
        foreach ($jsonList as $item){
            Neighborhood::query()->create([
                'id' => $item->mahalle_id,
                'neighborhood_name' => $item->mahalle_adi,
                'district_id' => $item->ilce_id,
            ]);
        }
    }
}
