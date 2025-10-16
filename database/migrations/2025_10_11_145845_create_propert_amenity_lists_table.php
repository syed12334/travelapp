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
        Schema::create('property_amenity_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('property_amenity_id');
            $table->integer('property_no_of_amenity');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('property_amenity_id')->references('id')->on('pamenities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propert_amenity_lists');
    }
};
