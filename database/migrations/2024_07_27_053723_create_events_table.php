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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->string('type_ar')->nullable();
            $table->string('type_en')->nullable();
            $table->string('place_ar')->nullable();
            $table->string('place_en')->nullable();
            $table->string('organizer_ar')->nullable();
            $table->string('organizer_en')->nullable();
            $table->text('phone')->nullable();
            $table->integer('order_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
