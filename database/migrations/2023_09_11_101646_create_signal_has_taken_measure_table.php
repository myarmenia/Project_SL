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
        Schema::create('signal_has_taken_measure', function (Blueprint $table) {
            $table->unsignedBigInteger('signal_id')->index('fk_signal_has_taken_measure_signal1_idx');
            $table->unsignedBigInteger('taken_measure_id')->index('fk_signal_has_taken_measure_taken_measure1_idx');

            $table->primary(['signal_id', 'taken_measure_id']);

            $table->foreign(['taken_measure_id'], 'fk_signal_has_taken_measure_taken_measure1')->references(['id'])->on('taken_measure')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['signal_id'], 'fk_signal_has_taken_measure_signal1')->references(['id'])->on('signal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signal_has_taken_measure');
    }
};
