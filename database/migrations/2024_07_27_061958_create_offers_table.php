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
            $table->unsignedBigInteger('user_id');
            $table->string('type')->comment('1 sell, 2 Rent , 3 Investment opportunity');
            $table->string('category')->nullable();
            $table->string('area')->nullable();
            $table->string('price')->nullable();
            $table->string('currency')->nullable()->comment('1 riyal, 2 dollar, 3 dirham');
            $table->string('city_ar')->nullable();
            $table->string('city_en')->nullable();
            $table->string('neighborhood_ar')->nullable();
            $table->string('neighborhood_en')->nullable();
            $table->string('place_ar')->nullable();
            $table->string('place_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->boolean('is_active')->default(0)->comment('1 active, 0 not active');
            $table->integer('order_by')->nullable();;

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

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
