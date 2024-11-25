<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rezyon\Checkouts\CheckoutStatusEnums;
use Rezyon\Companies\Models\Companies;
use Rezyon\PaymentManagement\Enums\PaymentMethodsEnum;
use Rezyon\Users\Models\Users;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_oid');
            $table->foreignIdFor(Users::class)->nullable()
                ->constrained()
                ->onDelete('cascade');;
            $table->foreignIdFor(Companies::class)->nullable()
                ->constrained()
                ->onDelete('cascade');;
            $table->enum('payment_service', PaymentMethodsEnum::values())->default(PaymentMethodsEnum::PAYTR->value);
            $table->float('amount');
            $table->json('meta')->nullable();
            $table->json('success')->nullable();
            $table->json('fail')->nullable();
            $table->enum('status', CheckoutStatusEnums::values())->default(CheckoutStatusEnums::WAITING_PAYMENT->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
