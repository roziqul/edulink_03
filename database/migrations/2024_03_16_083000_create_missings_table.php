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
        Schema::create('missings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reserved_id')->nullable();
            $table->enum('status', ['approved', 'waiting_approval', 'not_approved'])->default('not_approved');
            $table->timestamps();

            $table->foreign('reserved_id')->references('id')->on('reserveds');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missings');
    }
};
