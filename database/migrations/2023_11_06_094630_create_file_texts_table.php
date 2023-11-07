<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_texts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('file_id');
            $table->longText('content');
            $table->timestamps();

            $table->foreign('file_id')->references('id')->on('file')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_texts');
    }
};
