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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Inquiry name
            $table->string('email'); // Inquiry email
            $table->string('phone'); // Inquiry phone number
            $table->text('message'); // Inquiry message
            $table->enum('status', ['new', 'in_progress', 'resolved'])->default('new'); // Inquiry status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
