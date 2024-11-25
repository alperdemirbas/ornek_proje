<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rezyon\Supplier\Enums\PriceTypes;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activity_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activity_id');
            $table->enum('type', PriceTypes::values());
            $table->float('price');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();

            $table->foreign('activity_id')
                ->references('id')->on('activities')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_prices');
    }
};
