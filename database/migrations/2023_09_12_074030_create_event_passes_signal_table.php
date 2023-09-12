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
        Schema::create('event_passes_signal', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id')->index('fk_event_has_signal_event1_idx');
            $table->unsignedBigInteger('signal_id')->index('fk_event_has_signal_signal1_idx');

            $table->primary(['event_id', 'signal_id']);

            $table->foreign(['signal_id'], 'fk_event_has_signal_signal1')->references(['id'])->on('signal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['event_id'], 'fk_event_has_signal_event1')->references(['id'])->on('event')->onUpdate('NO ACTION')->onDelete('NO ACTION');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_passes_signal');
    }
};
