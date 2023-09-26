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
        Schema::create('tmp_man_find_texts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('patronymic')->nullable();
            $table->string('birthday')->nullable();
            $table->unsignedTinyInteger('birth_day')->nullable();
            $table->unsignedTinyInteger ('birth_month')->nullable();
            $table->year('birth_year')->nullable();
            $table->text('address')->nullable();
            $table->text('find_text')->nullable();
            $table->text('paragraph')->nullable();
            $table->string('file_name')->nullable();
            $table->string('real_file_name')->nullable();
            $table->string('file_path')->nullable();
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
        Schema::dropIfExists('tmp_man_find_texts');
    }
};
