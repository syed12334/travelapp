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
        Schema::create('property_personal_details', function (Blueprint $table) {
            $table->id('property_personal_details_id');
            $table->unsignedBigInteger('property_id');
            $table->string('name_of_host');
            $table->string('email',120);
            $table->string('mobile_no',15);
            $table->string('whatsapp_no',15)->nullable();
            $table->string('profile_img');
            $table->string('language_speak',70)->nullable();
            $table->year('hosting_since')->nullable();
            $table->integer('total_num_properties')->nullable();
            $table->text('personal_description')->nullable();
            $table->timestamps();
            $table->foreign('property_id')->references('property_id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_personal_details');
    }
};
