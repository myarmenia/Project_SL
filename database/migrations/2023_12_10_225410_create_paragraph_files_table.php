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
        Schema::create('paragraph_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('man_id');
            $table->foreign('man_id')->references('id')->on('man')->onDelete('cascade')->onUpdate('cascade');
            $table->string('file_name')->nullable();
            $table->string('path')->nullable();
            $table->longText('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paragraph_files');
    }
};
