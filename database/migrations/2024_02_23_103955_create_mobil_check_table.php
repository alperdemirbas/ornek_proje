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
        Schema::create('mobil_check', function (Blueprint $table) {
            $table->id();
            $table->enum('deadlock',['ios','android','none','all'])->default('none');
            $table->json('store')->comment('Platformların market store_url, store_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobil_check');
    }
};
