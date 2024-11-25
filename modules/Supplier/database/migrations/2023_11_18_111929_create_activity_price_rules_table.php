<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rezyon\Supplier\Enums\PriceRuleGenders;
use Rezyon\Supplier\Enums\PriceRuleOperators;
use Rezyon\Supplier\Enums\PriceRules;
use Rezyon\Supplier\Models\Activity;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activity_price_rules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activity_id');

            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();

            $table->enum('rule', PriceRules::values());
            $table->enum('gender', PriceRuleGenders::values());
            $table->integer('age')->default(0);
            $table->enum('operator', PriceRuleOperators::values());

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
        Schema::dropIfExists('activity_price_rules');
    }
};
