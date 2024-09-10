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
        Schema::create('reserveds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('serial_id')->nullable();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->integer('duration')->nullable();
            $table->date('start_date')->nullable();
            $table->date('due_date')->nullable();
            $table->date('return_date')->nullable();
            $table->integer('overdue')->nullable();
            $table->integer('total_bill')->nullable();
            $table->enum('bill_status', ['paid', 'not_paid', 'no_bill'])->default('no_bill');
            $table->enum('rsv_status', ['finished', 'not_finished'])->default('not_finished');
            $table->string('info')->nullable();
            $table->unsignedBigInteger('verified_by')->nullable();
            $table->timestamps();

            $table->foreign('serial_id')->references('id')->on('serials');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('verified_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserveds');
    }
};
