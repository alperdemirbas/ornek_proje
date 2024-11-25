<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rezyon\TourismCompany\Models\TourismCompanyGroup;
use Rezyon\TourismCompanyUser\Models\Users;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tourism_company_group_users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Users::class)
                ->constrained()
                ->onDelete('cascade');;
            $table->foreignIdFor(TourismCompanyGroup::class)
                ->constrained()
                ->onDelete('cascade');;
            $table->string('sub_group_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourism_company_group_users');
    }
};
