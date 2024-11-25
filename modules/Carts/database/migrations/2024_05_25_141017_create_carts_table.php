<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\Rezyon\Supplier\Models\Activity::class);
            $table->foreignIdFor(\Rezyon\Users\Models\Users::class);
            $table->string('price');
            $table->timestamp('selected_time');
            $table->foreignIdFor(\Rezyon\Supplier\Models\ActivitySession::class)->nullable();
            $table->integer('adult')->default(0);
            $table->integer('child')->default(0);
            $table->integer('baby')->default(0);
            $table->boolean('status')->comment('sepetin ödemesi yapıldıysa 1 yapılmadıysa 0');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
