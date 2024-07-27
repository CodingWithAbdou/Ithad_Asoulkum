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
            $table->text('note_ar')->nullable();
            $table->text('note_en')->nullable();
            $table->text('phone')->nullable();
            $table->date('date')->nullable();
            $table->string('place_ar')->nullable();
            $table->string('place_en')->nullable();
            $table->string('type_ar')->nullable();
            $table->string('type_en')->nullable();
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
