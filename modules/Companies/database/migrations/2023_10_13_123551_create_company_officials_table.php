<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rezyon\Companies\Models\Companies;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('company_officials', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Companies::class)
                ->constrained()
                ->onDelete('cascade');;
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('title')->nullable();
            $table->string('phone');
            $table->string('phone_country');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_officials');
    }
};
