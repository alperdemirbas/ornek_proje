<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\Rezyon\Companies\Models\Users::class);
            $table->foreignIdFor(\Rezyon\Supplier\Models\Activity::class);
            $table->foreignIdFor(\Rezyon\Hotels\Models\Hotel::class);
            $table->foreignIdFor(\Rezyon\Supplier\Models\ActivitySession::class)->nullable();
            $table->foreignIdFor(\Rezyon\Transfers\Models\Cars::class);
            $table->timestamp('time');
            $table->timestamp('date');
            $table->string('driver_name');
            $table->string('driver_phone');
            $table->string('driver_phone_country');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
