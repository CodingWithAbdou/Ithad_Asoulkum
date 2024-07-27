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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('type')->comment('1 sell, 2 Rent , 3 Investment opportunity');
            $table->string('category')->nullable();
            $table->string('price')->nullable();
            $table->string('place_ar')->nullable();
            $table->string('place_en')->nullable();
            $table->string('city_ar')->nullable();
            $table->string('city_en')->nullable();
            $table->string('street_ar')->nullable();
            $table->string('street_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
