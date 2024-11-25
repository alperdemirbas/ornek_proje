<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rezyon\TourismCompanyUser\Enums\GenderEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->after('email')->default('5555555555');
            $table->string('phone_country')->after('phone')->default('TR');
            $table->timestamp('birthdate')->after('phone_country')->default(Carbon::parse('1999-01-01'));
            $table->enum('gender', [GenderEnum::values()])->after('birthdate')->default(GenderEnum::MALE->value);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('phone_country');
            $table->dropColumn('birthdate');
            $table->dropColumn('gender');
        });
    }
};
