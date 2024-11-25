<?php

namespace Rezyon\Locations\Databases\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Rezyon\Locations\Models\Street;

class StreetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $streetList = file_get_contents(__DIR__ . '/../../resources/street.json');
        $jsonList = json_decode($streetList);
        foreach ($jsonList as $item){
            Street::query()->create([
                'id' => $item->sokak_id,
                'street_name' => $item->sokak_adi,
                'neighborhood_id' => $item->mahalle_id,
            ]);
        }
    }
}
