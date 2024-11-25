<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rezyon\TourismCompany\Models\TourismCompanyActivity;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tourism_company_activity_closed_days', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tourism_activity_id');
            $table->foreign('tourism_activity_id')
                ->references('id')->on('tourism_company_activities')
                ->onDelete('cascade');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourism_company_activity_closed_days');
    }
};
