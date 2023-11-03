<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('photos', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('add_id');
        $table->foreign('add_id')->references('id')->on('adds')->onDelete('cascade');
        $table->string('filename');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
