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
        Schema::create('event_has_qualification', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id')->index('fk_event_has_event_qualification_event1_idx');
            $table->unsignedBigInteger('qualification_id')->index('fk_event_has_event_qualification_event_qualification1_idx');

            $table->primary(['event_id', 'qualification_id']);

            $table->foreign(['qualification_id'], 'fk_event_has_event_qualification_event_qualification1')->references(['id'])->on('event_qualification')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['event_id'], 'fk_event_has_event_qualification_event1')->references(['id'])->on('event')->onUpdate('NO ACTION')->onDelete('NO ACTION');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_has_qualification');
    }
};
