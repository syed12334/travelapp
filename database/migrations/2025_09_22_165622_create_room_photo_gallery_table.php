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
        Schema::create('room_photo_gallery', function (Blueprint $table) {
                $table->id();
            $table->unsignedBigInteger('room_id');
            $table->string('photos');
            $table->timestamps();
            $table->foreign('room_id')->references('id')->on('room_categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_photo_gallery');
    }
};
