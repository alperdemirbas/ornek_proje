<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rezyon\Companies\Enums\OrderStates;
use Rezyon\Companies\Models\Companies;
use Rezyon\Packages\Models\Packages;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Companies::class)
                ->constrained()
                ->onDelete('cascade');;
            $table->foreignIdFor(Packages::class)
                ->constrained()
                ->onDelete('cascade');;
            $table->enum('state',OrderStates::values())->default(OrderStates::CREATED);
            $table->json('error');
            $table->json('success');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies_orders');
    }
};
