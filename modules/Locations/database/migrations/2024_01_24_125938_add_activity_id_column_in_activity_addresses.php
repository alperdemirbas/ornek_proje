<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rezyon\Supplier\Models\Activity;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('activity_addresses', function (Blueprint $table) {
            $table->foreignIdFor(Activity::class,'activity_id')
                ->after('id')
                ->constrained()
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity_addresses', function (Blueprint $table) {
            $table->dropColumn('activity_id');
        });
    }
};
