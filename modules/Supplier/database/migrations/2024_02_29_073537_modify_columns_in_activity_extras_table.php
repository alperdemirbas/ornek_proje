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
        Schema::table('activity_extras', function (Blueprint $table) {
            $table->dropColumn('include_price');
            $table->dropColumn('not_include_price');
            $table->dropColumn('advice');
            $table->enum('key', ['include_price', 'not_include_price', 'advice'])->default('include_price');
            $table->string('value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity_extras', function (Blueprint $table) {
            $table->string('include_price')->nullable();
            $table->string('not_include_price')->nullable();
            $table->string('advice')->nullable();
        });
    }
};
