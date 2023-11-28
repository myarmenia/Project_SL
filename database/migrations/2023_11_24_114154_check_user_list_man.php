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
        Schema::create('check_user_list_man', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('check_user_list_id');
            $table->unsignedBigInteger('man_id');
            $table->string('procent')->nullable();
            // $table->foreign('check_user_list_id')->references('id')->on('check_user_lists');
            // $table->foreign('man_id')->references('id')->on('man');
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
        //
    }
};
