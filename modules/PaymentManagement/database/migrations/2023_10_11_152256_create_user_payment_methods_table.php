<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Rezyon\PaymentManagement\Enums\PaymentMethodsEnum;
use Rezyon\Users\Models\Users;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
//        Schema::create('companies', function (Blueprint $table) {
//            $table->id();
//            $table->string('domain');
//            $table->enum("type", PaymentMethodsEnum::names())
//                ->default(PaymentMethodsEnum::PAYTR->name)
//                ->comment("Odeme Yontemi");
//            $table->boolean('is_default');
//            $table->timestamps();
//        });
//        Artisan::call("db:seed",['--force'=>true,'--class'=>'\Rezyon\PaymentManagement\Seeds\PaymentMethodsSeeder']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_payment_methods');
    }
};
