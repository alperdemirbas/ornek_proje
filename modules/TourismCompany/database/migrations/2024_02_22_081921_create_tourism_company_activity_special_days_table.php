<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rezyon\Companies\Models\Companies;
use Rezyon\Supplier\Models\Activity;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tourism_company_activity_special_days', function (Blueprint $table) {
            $table->id();
            $table->integer('profitability')->default(0);
            $table->foreignIdFor(Companies::class)
                ->constrained()
                ->onDelete('cascade');;
            $table->foreignIdFor(Activity::class)
                ->constrained()
                ->onDelete('cascade');;
            $table->dateTime('start_date');
            $table->dateTime('end_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourism_company_activity_special_days');
    }
};
