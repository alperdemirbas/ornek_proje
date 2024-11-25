<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rezyon\Locations\Models\Street;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activity_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Street::class)
                ->constrained()
                ->onDelete('cascade');;
            $table->string('detail')->nullable(true)->comment('Adres devamı');
            $table->string('directions')->nullable(true)->comment('Açık adres tarifi');
            $table->string('latitude');
            $table->string('longitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_addresses');
    }
};
