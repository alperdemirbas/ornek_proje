<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rezyon\Flights\Enums\StatusEnums;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flight_users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\Rezyon\Flights\Models\Flights::class);
            $table->foreignIdFor(\Rezyon\Users\Models\Users::class);
            $table->enum('status', StatusEnums::values())->default(StatusEnums::NA->value);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_customers');
    }
};
