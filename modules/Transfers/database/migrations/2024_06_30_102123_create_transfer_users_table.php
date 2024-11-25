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
        Schema::create('transfer_users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\Rezyon\Companies\Models\Users::class);
            $table->foreignIdFor(\Rezyon\Transfers\Models\Transfers::class);
            $table->timestamp('pickup_time')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_users');
    }
};
