<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Rezyon\Packages\Enums\PackageTypesEnums;
use Rezyon\Packages\Models\Packages;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Packages::query()->updateOrCreate(['id' => 1],
            [
                'name' => 'SUPPLER Package',
                'is_active' => true,
                'quarter_yearly_discount' =>1,
                'half_yearly_discount' => 2,
                'yearly_discount'=>3,
                'fee' => 69.90,
                'type' => PackageTypesEnums::SUPPLIER
            ],
        );
        Packages::query()->updateOrCreate(['id' => 2],
            [
                'name' => 'TOURISM COMPANY Package',
                'is_active' => true,
                'quarter_yearly_discount' =>1,
                'half_yearly_discount' => 2,
                'yearly_discount'=>3,
                'fee' => 69.90,
                'type' => PackageTypesEnums::TOURISM_COMPANY
            ],
        );
    }
}
