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
        Schema::create('action_passes_signal', function (Blueprint $table) {
            $table->unsignedBigInteger('action_id')->index('fk_action_has_signal_action1_idx');
            $table->unsignedBigInteger('signal_id')->index('fk_action_has_signal_signal1_idx');

            $table->primary(['action_id', 'signal_id']);

            $table->foreign(['signal_id'], 'fk_action_has_signal_signal1')->references(['id'])->on('signal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['action_id'], 'fk_action_has_signal_action1')->references(['id'])->on('action')->onUpdate('NO ACTION')->onDelete('NO ACTION');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_passes_signal');
    }
};
