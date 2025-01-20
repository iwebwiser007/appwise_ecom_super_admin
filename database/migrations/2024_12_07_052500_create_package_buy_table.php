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
        Schema::create('package_buy', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_id')->nullable();
            $table->unsignedBigInteger('shop_owner_id')->nullable();
            $table->string('package_name')->nullable();
            $table->string('description')->nullable();
            $table->integer('number_of_section')->nullable();
            $table->integer('number_of_category')->nullable();
            $table->integer('number_of_product')->nullable();
            $table->integer('price')->nullable();
            $table->integer('days')->nullable();
            $table->string('status')->nullable()->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */ 
    public function down(): void
    {
        Schema::dropIfExists('package_buy');
    }
};
