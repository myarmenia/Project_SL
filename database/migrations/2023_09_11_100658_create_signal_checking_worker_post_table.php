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
        Schema::create('signal_checking_worker_post', function (Blueprint $table) {
            $table->unsignedBigInteger('signal_id')->index('signal_id');
            $table->unsignedBigInteger('worker_post_id')->index('worker_post_id');

            $table->foreign(['worker_post_id'], 'signal_checking_worker_post_ibfk_2')->references(['id'])->on('worker_post')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['signal_id'], 'signal_checking_worker_post_ibfk_1')->references(['id'])->on('signal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signal_checking_worker_post');
    }
};
