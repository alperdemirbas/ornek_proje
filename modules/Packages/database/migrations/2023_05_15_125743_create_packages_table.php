<?php

namespace Rezyon\Packages\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rezyon\Packages\Enums\PackageTypesEnums;


return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(1)->comment('Paket Aktif mi?');
            $table->float('quarter_yearly_discount')->comment('3 Aylik Iskonto');
            $table->float('half_yearly_discount')->comment('6 Aylik Iskonto');
            $table->float('yearly_discount')->comment('Iskonto Yillik');
            $table->float('fee')->comment('Ucret');
            $table->enum('type', PackageTypesEnums::values())->default( PackageTypesEnums::SUPPLIER->value );
            $table->timestamps();
            $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
