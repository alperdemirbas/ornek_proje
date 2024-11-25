<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rezyon\Flights\Enums\FlightStatusEnums;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\Rezyon\Users\Models\Users::class);
            $table->string('flight_number')->comment("Uçuş numarası");
            $table->text('detail')->nullable()->comment("Uçuş ile alakalı detaylar");
            $table->dateTime('departure_time')->comment("Kalkış zamanı");
            $table->string('departure_airport')->comment("Kalkış Havaalanı");
            $table->dateTime('arrival_time')->comment("İniş zamanı");
            $table->string('arrival_airport')->comment("İniş Havaalanı");
            $table->dateTime('return')->comment("Uçuş geri dönüş zamanı");
            $table->enum('status', FlightStatusEnums::values())->default(FlightStatusEnums::ACTIVE->value)->comment("Uçuş Durumu");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
