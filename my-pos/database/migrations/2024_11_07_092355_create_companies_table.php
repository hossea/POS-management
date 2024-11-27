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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->default('Laravel Pos');
            $table->string('company_address')->default('Laravel Pos address');
            $table->string('company_phone')->default('+25488779768');
            $table->string('company_email')->default('laravelpos@laravel.gm');
            $table->string('company_fax')->default('+254792651872');
            $table->timestamps();
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
