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
        Schema::create('serials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('catalog_id')->nullable();
            $table->bigInteger('registration_number')->unique()->nullable();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('authorized_by')->nullable();
            $table->enum('status', ['available', 'not_available', 'missing'])->default('available');
            $table->timestamps();

            $table->foreign('authorized_by')->references('id')->on('administrators');
            $table->foreign('catalog_id')->references('id')->on('catalogs');
            $table->foreign('student_id')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serials');
    }
};
