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
        Schema::create('allergen_plate', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plate_id');
            $table->unsignedBigInteger('allergen_id');
            $table->timestamps();

            $table->foreign('plate_id')->references('id')->on('plates')->onDelete('cascade');
            $table->foreign('allergen_id')->references('id')->on('allergens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allergen_plate');
    }
};
