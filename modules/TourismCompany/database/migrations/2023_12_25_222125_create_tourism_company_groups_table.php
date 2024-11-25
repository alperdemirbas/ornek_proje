<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rezyon\Companies\Models\Users;
use Rezyon\TourismCompany\Enums\GroupStatus;
use Rezyon\TourismCompany\Enums\GroupTypes;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tourism_company_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Users::class)
                ->constrained()
                ->onDelete('cascade');;
            $table->string('name')->unique();
            $table->enum('type', GroupTypes::values())->default(GroupTypes::OTHER);
            $table->enum('status', GroupStatus::values())->default(GroupStatus::WAITING_ARRIVE);
            $table->dateTime('arrival_date');
            $table->dateTime('date_of_return');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourism_company_groups');
    }
};
