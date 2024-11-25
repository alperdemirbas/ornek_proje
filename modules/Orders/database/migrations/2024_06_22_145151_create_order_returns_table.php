<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rezyon\Orders\Enums\OrderReturnStatusEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_returns', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\Rezyon\Carts\Models\Carts::class);
            $table->string('reference_no');
            $table->float('return_amount');
            $table->enum('status', OrderReturnStatusEnum::values())->default(OrderReturnStatusEnum::PENDING->value);
            $table->string('err_no')->nullable();
            $table->string('err_msg')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_returns');
    }
};
