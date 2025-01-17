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
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('album_id')->nullable();
            $table->unsignedBigInteger('artist_id');
            $table->string('genre')->nullable();
            $table->integer('duration')->nullable();
            $table->year('release_year')->nullable();
            $table->string('file_path');
            $table->timestamps();

            $table->foreign('album_id')->references('id')->on('albums')->nullOnDelete();
            $table->foreign('artist_id')->references('id')->on('artists')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracks');
    }
};
