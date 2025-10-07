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
        Schema::create('properties', function (Blueprint $table) {
            $table->id('property_id');
            $table->uuid('property_uuid')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('property_name');
            $table->year('booking_start_year');
            $table->year('property_built_date');
            $table->string('property_hosted',50);
            $table->enum('host_stay_property', ['yes', 'no']);
            $table->string('email');
            $table->string('mobile_no',15);
            $table->string('whatsapp_no',15)->nullable();
            $table->string('landline_no',15)->nullable();
            $table->text('property_location');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
