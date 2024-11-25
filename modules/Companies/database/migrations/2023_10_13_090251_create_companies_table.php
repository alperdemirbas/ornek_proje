<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Rezyon\Companies\Enums\CompanyTypeEnums;
use Rezyon\Companies\Models\Companies;


return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Firma Adi');
            $table->string('email')->comment('Firma Adi');
            $table->string('phone');
            $table->string('phone_country');
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            $table->enum('type', CompanyTypeEnums::values())->default( CompanyTypeEnums::TOURISM_COMPANY->value );
            $table->boolean('is_active')->default(false)->comment('Firma Aktif mi?');
            $table->string('domain')->comment('Subdomain')->nullable();
            $table->timestamp('verify_at')->nullable()->comment('Belgelerin onaylandigi tarih');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
