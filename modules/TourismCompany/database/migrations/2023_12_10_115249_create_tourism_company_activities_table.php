<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rezyon\Companies\Models\Companies;
use Rezyon\Supplier\Models\Activity;
use Rezyon\TourismCompany\Enums\ActivityStatus;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tourism_company_activities', function (Blueprint $table) {
            $table->id();
            $table->integer('profitability')->default(0);
            $table->foreignIdFor(Companies::class)
                ->constrained()
                ->onDelete('cascade');;
            $table->foreignIdFor(Activity::class)
                ->constrained()
                ->onDelete('cascade');;
            $table->enum('status', ActivityStatus::values())->default(ActivityStatus::WAITING_APPROVE);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourism_company_activities');
    }
};
