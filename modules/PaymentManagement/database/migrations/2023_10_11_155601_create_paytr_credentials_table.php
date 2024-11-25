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
//        Schema::create('paytr_credentials', function (Blueprint $table) {
//            $table->id();
//            $table->string('domain');
//            $table->string('merchant_id');
//            $table->string('merchant_key');
//            $table->string('merchant_salt');
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paytr_credentials');
    }
};
