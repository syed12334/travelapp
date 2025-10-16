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
        Schema::create('property_room_category_amenities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_roomc_id');
            $table->unsignedBigInteger('room_amenity_id')->nullable();
            $table->foreign('property_roomc_id')->references('id')->on('property_room_categories')->onDelete('cascade');
            $table->foreign('room_amenity_id')->references('id')->on('amenities')->onDelete('cascade');
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_room_category_amenities');
    }
};
