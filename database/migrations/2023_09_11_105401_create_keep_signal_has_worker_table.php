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
        Schema::create('keep_signal_has_worker', function (Blueprint $table) {
            $table->unsignedBigInteger('keep_signal_id')->index('fk_conduct_signal_has_worker_conduct_signal1');
            $table->unsignedBigInteger('worker_id')->index('fk_conduct_signal_has_worker_worker1');

            $table->primary(['keep_signal_id', 'worker_id']);

            $table->foreign(['worker_id'], 'fk_conduct_signal_has_worker_worker1')->references(['id'])->on('worker')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['keep_signal_id'], 'fk_conduct_signal_has_worker_conduct_signal1')->references(['id'])->on('keep_signal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keep_signal_has_worker');
    }
};
