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
        Schema::create('action_has_event', function (Blueprint $table) {
            $table->unsignedBigInteger('action_id')->index('fk_action_has_event_action1_idx');
            $table->unsignedBigInteger('event_id')->index('fk_action_has_event_event1_idx');

            $table->primary(['action_id', 'event_id']);

            $table->foreign(['event_id'], 'fk_action_has_event_event1')->references(['id'])->on('event')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['action_id'], 'fk_action_has_event_action1')->references(['id'])->on('action')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_has_event');
    }
};
