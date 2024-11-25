<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rezyon\Companies\Models\Companies;
use Rezyon\Supplier\Enums\PriceCurrency;
use Rezyon\Supplier\Models\ActivityCategory;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Companies::class)->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('description');
            $table->integer('duration')->default(0);
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->boolean('is_active')->default(true);
            $table->enum('currency', PriceCurrency::values());
            $table->unsignedBigInteger('views')->default(0);
            $table->foreignIdFor(ActivityCategory::class);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
