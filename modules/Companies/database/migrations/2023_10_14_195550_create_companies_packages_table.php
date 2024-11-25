<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rezyon\Companies\Enums\PaymentFrequencyEnums;
use Rezyon\Companies\Enums\PaymentStatusesEnums;
use Rezyon\Companies\Models\Companies;
use Rezyon\Packages\Models\Packages;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Packages::class)
                ->constrained()
                ->onDelete('cascade');;
            $table->foreignIdFor(Companies::class)
                ->constrained()
                ->onDelete('cascade');;
            $table->enum('payment_frequency', PaymentFrequencyEnums::values())->default(PaymentFrequencyEnums::MONTHLY);
            $table->enum('payment_status', PaymentStatusesEnums::values())->default(PaymentStatusesEnums::WAITING_VERIFICATION);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies_packages');
    }
};
