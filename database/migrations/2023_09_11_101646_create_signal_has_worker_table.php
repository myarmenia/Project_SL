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
        Schema::create('signal_has_worker', function (Blueprint $table) {
            $table->unsignedBigInteger('signal_id')->index('fk_signal_has_worker_signal2');
            $table->unsignedBigInteger('worker_id')->index('fk_signal_has_worker_worker2');

            $table->primary(['signal_id', 'worker_id']);

            $table->foreign(['worker_id'], 'fk_signal_has_worker_worker2')->references(['id'])->on('worker')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['signal_id'], 'fk_signal_has_worker_signal2')->references(['id'])->on('signal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signal_has_worker');
    }
};
