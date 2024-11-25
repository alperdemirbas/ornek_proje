<?php

namespace Rezyon\Companies\Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Rezyon\Companies\Enums\CompanyTypeEnums;
use Rezyon\Companies\Enums\PaymentFrequencyEnums;
use Rezyon\Companies\Enums\PaymentStatusesEnums;
use Rezyon\Companies\Models\Companies;
use Rezyon\Companies\Models\CompaniesPackages;
use Rezyon\Companies\Models\CompanyOfficials;
use Rezyon\Companies\Models\Users;
use Rezyon\Users\Enums\Types;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supplierPermissions = [];
        $tourismPermissions = [];
        foreach (config('permissions') as $root => $group) {
            if (!empty($group['supplier'])) {
                foreach ($group['supplier'] as $item) {
                    $supplierPermissions[] = $item;
                }
            }
            if (!empty($group['tourism_company'])) {
                foreach ($group['tourism_company'] as $item) {
                    $tourismPermissions[] = $item;
                }
            }
        }

        $faker = Factory::create();
        $company = Companies::factory()->create(
            [
                'name' => $faker->company(),
                'domain' => 'demo-tourism',
                'email' => $faker->companyEmail(),
                'phone' => $faker->numerify('532#######'),
                'phone_country' => 'TR',
                'is_active' => true,
                'address' => $faker->address(),
                'description' => $faker->realText('20'),
                'verify_at' => Carbon::now(),
                'type' => CompanyTypeEnums::TOURISM_COMPANY,
            ]
        );
        $official = CompanyOfficials::factory()->create([
            'companies_id' => $company->id
        ]);

        CompaniesPackages::query()->create([
            'packages_id' => 2,
            'companies_id' => $company->id,
            'payment_frequency' => PaymentFrequencyEnums::YEARLY,
            'payment_status' => PaymentStatusesEnums::PAYMENT_SUCCESS,
            'start_date' => Carbon::now()->startOfDay(),
            'end_date' => Carbon::now()->addYear()->endOfDay()
        ]);

        $tourismUser = Users::factory()->create([
            'companies_id' => $company->id,
            'email' => $official->email,
            'type' => Types::TOURISM_COMPANY,
            'pnr' => null,
        ]);
        

        $tourismUser->givePermissionTo($tourismPermissions);

        $company1 = Companies::factory()->create([
                'name' => $faker->company(),
                'domain' => 'demo-supplier',
                'email' => $faker->companyEmail(),
                'phone' => $faker->numerify('532#######'),
                'phone_country' => 'TR',
                'is_active' => true,
                'address' => $faker->address(),
                'description' => $faker->realText('20'),
                'verify_at' => Carbon::now(),
                'type' => CompanyTypeEnums::SUPPLIER
            ]
        );
        $official1 = CompanyOfficials::factory()->create([
            'companies_id' => $company1->id
        ]);

        CompaniesPackages::query()->create([
            'packages_id' => 1,
            'companies_id' => $company1->id,
            'payment_frequency' => PaymentFrequencyEnums::YEARLY,
            'payment_status' => PaymentStatusesEnums::PAYMENT_SUCCESS,
            'start_date' => Carbon::now()->startOfDay(),
            'end_date' => Carbon::now()->addYear()->endOfDay()
        ]);

        $supplierUser = Users::factory()->create([
            'companies_id' => $company1->id,
            'email' => $official1->email,
            'type' => Types::SUPPLIER,
            'pnr' => null,
        ]);
        $supplierUser->givePermissionTo($supplierPermissions);
    }
}