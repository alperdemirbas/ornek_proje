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
        Schema::create('activity_extras', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\Rezyon\Supplier\Models\Activity::class)
                ->constrained()
                ->onDelete('cascade');;
            $table->string('include_price')->nullable();
            $table->string('not_include_price')->nullable();
            $table->string('advice')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_extras');
    }
};
