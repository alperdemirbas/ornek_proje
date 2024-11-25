<?php

namespace Rezyon\Paytr\Seeder;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PaymentGatewaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_gateways')->insert([
            [
                'gateway' => 'PAYTR',
                'credentials' => json_encode([
                    'merchant_id' => 311582,
                    'merchant_key' => "76rLH62Dk9UwfoKT",
                    'merchant_salt' => "U2fRz1se6kbipxmT"
                ]),
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
