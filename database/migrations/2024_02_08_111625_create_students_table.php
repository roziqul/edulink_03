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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('photo')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('nisn')->unique()->nullable();
            $table->string('class')->nullable();
            $table->string('fullname')->nullable();
            $table->string('pob')->nullable();
            $table->date('dob')->nullable();
            $table->enum('gender', ['L', 'P']);
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('role')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
