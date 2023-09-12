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
        Schema::create('keep_signal_worker_post', function (Blueprint $table) {
            $table->unsignedBigInteger('keep_signal_id')->index('keep_signal_id');
            $table->unsignedBigInteger('worker_post_id')->index('worker_post_id');

            $table->foreign(['worker_post_id'], 'keep_signal_worker_post_ibfk_2')->references(['id'])->on('worker_post')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['keep_signal_id'], 'keep_signal_worker_post_ibfk_1')->references(['id'])->on('keep_signal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keep_signal_worker_post');
    }
};
