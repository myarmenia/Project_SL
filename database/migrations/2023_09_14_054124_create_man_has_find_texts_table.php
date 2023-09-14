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
        Schema::create('man_has_find_texts', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('man_id')->nullable();
            $table->unsignedTinyInteger('file_id')->nullable();
            $table->text('find_text')->nullable();
            $table->text('paragraph')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('man_has_find_texts');
    }
};
