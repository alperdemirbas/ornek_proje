<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rezyon\TourismCompany\Enums\GroupStatus;
use Rezyon\TourismCompany\Enums\GroupTypes;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tourism_company_group_users', function (Blueprint $table) {
            $table->enum('type', GroupTypes::values())->default(GroupTypes::OTHER)->after('sub_group_id');
            $table->enum('status', GroupStatus::values())->default(GroupStatus::WAITING_ARRIVE)->after('sub_group_id');
            $table->dateTime('arrival_date')->after('sub_group_id');
            $table->dateTime('date_of_return')->after('sub_group_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tourism_company_groups_users', function (Blueprint $table) {
            $table->dropColumn(['type', 'status', 'arrival_date','date_of_return']);
        });
    }
};
