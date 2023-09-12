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
        Schema::create('keep_signal_worker', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('keep_signal_id')->index('keep_signal_id');
            $table->string('worker');

            $table->foreign(['keep_signal_id'], 'keep_signal_worker_ibfk_1')->references(['id'])->on('keep_signal')->onUpdate('NO ACTION')->onDelete('NO ACTION');

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
        Schema::dropIfExists('keep_signal_worker');
    }
};
