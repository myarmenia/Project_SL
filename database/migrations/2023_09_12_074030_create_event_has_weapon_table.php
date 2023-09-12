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
        Schema::create('event_has_weapon', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id')->index('fk_event_has_weapon_event1_idx');
            $table->unsignedBigInteger('weapon_id')->index('fk_event_has_weapon_weapon1_idx');

            $table->primary(['event_id', 'weapon_id']);

            $table->foreign(['weapon_id'], 'fk_event_has_weapon_weapon1')->references(['id'])->on('weapon')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['event_id'], 'fk_event_has_weapon_event1')->references(['id'])->on('event')->onUpdate('NO ACTION')->onDelete('NO ACTION');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_has_weapon');
    }
};
