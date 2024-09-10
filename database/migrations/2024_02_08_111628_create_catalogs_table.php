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
        Schema::create('catalogs', function (Blueprint $table) {
            $table->id();
            $table->string('isbn')->nullable();
            $table->string('cover')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('title')->nullable();
            $table->string('writer')->nullable();
            $table->string('publisher')->nullable();
            $table->string('release_year')->nullable();
            $table->string('price')->nullable();
            $table->string('edition')->nullable();
            $table->unsignedBigInteger('classification_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('classification_id')->references('id')->on('book_classifications');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogs');
    }
};
