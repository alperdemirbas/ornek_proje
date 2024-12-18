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
            $table->unsignedBigInteger('activity_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');

            $table->foreign('activity_id')
                ->references('id')->on('activities')
                ->onDelete('cascade');
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
