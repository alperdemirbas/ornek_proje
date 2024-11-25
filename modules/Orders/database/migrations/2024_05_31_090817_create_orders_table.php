<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rezyon\Discounts\Models\Discounts;
use Rezyon\Orders\Enums\OrderStatusEnum;
use Rezyon\Orders\Enums\OrderTypeEnum;
use Rezyon\Orders\Enums\PaymentTypeEnum;
use Rezyon\PaymentManagement\Services\Paytr\Enums\CurrencyEnums;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\Rezyon\Users\Models\Users::class);
            $table->integer('count');
            $table->string('merchant_oid')->unique();
            $table->string('user_ip');
            $table->float('amount');
            $table->float('total_amount')->nullable();
            $table->integer('installment_count')->default(0);
            $table->enum('status', OrderStatusEnum::values())->default(OrderStatusEnum::PENDING->value);
            $table->enum('currency', CurrencyEnums::values())->default(CurrencyEnums::TRY->value);
            $table->foreignIdFor(Discounts::class)->nullable();
            $table->integer('failed_reason_code')->nullable();
            $table->string('failed_reason_msg')->nullable();
            $table->enum('payment_type', PaymentTypeEnum::values())->default(PaymentTypeEnum::CARD);
            $table->enum('order_type', OrderTypeEnum::values())->default(OrderTypeEnum::ONETIME);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
