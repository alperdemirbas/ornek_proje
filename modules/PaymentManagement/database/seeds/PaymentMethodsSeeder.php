<?php

namespace Rezyon\PaymentManagement\Seeds;

use Illuminate\Database\Seeder;
use Rezyon\PaymentManagement\Enums\PaymentMethodsEnum;
use Rezyon\PaymentManagement\Models\UserPaymentMethods;
use Rezyon\Users\Models\Users;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $domains = Users::select('domain')
            ->groupBy('domain')
            ->get();
        foreach($domains as $domain){
            UserPaymentMethods::query()->create([
                'domain' => $domain->domain,
                'type' => PaymentMethodsEnum::PAYTR->name,
               'is_default'=> 1
            ]);
        }
    }
}
