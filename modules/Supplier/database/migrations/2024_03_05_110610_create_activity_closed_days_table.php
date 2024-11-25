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
        Schema::create('activity_closed_days', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\Rezyon\Supplier\Models\Activity::class)
                ->constrained()
                ->onDelete('cascade');;
            $table->integer('day');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_closed_days');
    }
};
