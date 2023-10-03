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
        Schema::create('action_has_weapon', function (Blueprint $table) {
            $table->unsignedBigInteger('action_id')->index('fk_action_has_weapon_action1_idx');
            $table->unsignedBigInteger('weapon_id')->index('fk_action_has_weapon_weapon1_idx');

            $table->primary(['action_id', 'weapon_id']);

            $table->foreign(['weapon_id'], 'fk_action_has_weapon_weapon1')->references(['id'])->on('weapon')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['action_id'], 'fk_action_has_weapon_action1')->references(['id'])->on('action')->onUpdate('NO ACTION')->onDelete('NO ACTION');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_has_weapon');
    }
};
