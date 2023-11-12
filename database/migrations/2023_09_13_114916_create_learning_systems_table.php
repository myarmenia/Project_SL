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
        Schema::create('learning_systems', function (Blueprint $table) {
            $table->id();
            $table->string('armenian')->nullable();
            $table->string('russian')->nullable();
            $table->string('english')->nullable();
            $table->unsignedBigInteger('chapter_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->boolean('editing_status')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('learning_systems');
    }
};
