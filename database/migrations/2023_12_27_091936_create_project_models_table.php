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
        Schema::create('project_models', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("parent_id");
            $table->tinyInteger("role_id")->default(1);
            $table->string("route_key")->nullable();
            $table->string('title_ar');
            $table->string('title_en');
            $table->tinyInteger("is_menu");
            $table->string('icon');
            $table->integer('order_by')->nullable();
            $table->string('model')->nullable();
            $table->string('model_name')->nullable();

            $table->tinyInteger('multi_language')->default('0')->comment('0 dont have seconde lang and 1 it hava');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
