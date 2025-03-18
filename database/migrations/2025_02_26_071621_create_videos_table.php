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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            // $table->string('video_id')->unique(); // ID unik untuk video
            $table->string('title'); // Judul video
            $table->text('description')->nullable(); // Deskripsi video
            $table->string('school_id');// Relasi ke schools
            $table->string('class_id'); // Relasi ke classes
            $table->string('url'); // URL video
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
