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
        Schema::create('tmp_man_find_texts_has_men', function (Blueprint $table) {
            $table->unsignedBigInteger('tmp_man_find_texts_id')->nullable();
            $table->unsignedBigInteger('man_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tmp_man_find_texts_has_men');
    }
};
