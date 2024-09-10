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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('catalog_id')->nullable();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->string('duration')->nullable();
            $table->enum('status', ['approved', 'not_approved', 'waiting'])->default('not_approved');
            $table->string('info')->nullable();
            $table->unsignedBigInteger('verified_by')->nullable();
            $table->timestamps();

            $table->foreign('catalog_id')->references('id')->on('catalogs');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('verified_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
