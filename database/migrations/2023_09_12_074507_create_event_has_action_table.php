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
        Schema::create('event_has_action', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id')->index('fk_event_has_action_event1_idx');
            $table->unsignedBigInteger('action_id')->index('fk_event_has_action_action1_idx');

            $table->primary(['event_id', 'action_id']);

            $table->foreign(['event_id'], 'fk_event_has_action_event1')->references(['id'])->on('event')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['action_id'], 'fk_event_has_action_action1')->references(['id'])->on('action')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_has_action');
    }
};
