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
        Schema::create('payers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('payment_id');
            $table->string('entity_type')->default('individual');
            $table->string('type')->default('customer');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payers');
    }
};
