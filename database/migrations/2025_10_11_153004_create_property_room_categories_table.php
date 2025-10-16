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
        Schema::create('property_room_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('room_category_id');
            $table->string('occupancy');
            $table->integer('no_of_rooms');
            $table->integer('price');
            $table->integer('tax');
            $table->integer('discount');
            $table->string('room_image');
            $table->text('rate_inclusion');
            $table->foreign('property_id')->references('property_id')->on('properties')->onDelete('cascade');
            $table->foreign('room_category_id')->references('id')->on('room_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_room_categories');
    }
};
