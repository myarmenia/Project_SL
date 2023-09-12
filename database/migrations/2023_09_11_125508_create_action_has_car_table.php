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
        Schema::create('action_has_car', function (Blueprint $table) {
            $table->unsignedBigInteger('action_id')->index('fk_action_has_car_action1_idx');
            $table->unsignedBigInteger('car_id')->index('fk_action_has_car_car1_idx');

            $table->primary(['action_id', 'car_id']);
            
            $table->foreign(['car_id'], 'fk_action_has_car_car1')->references(['id'])->on('car')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['action_id'], 'fk_action_has_car_action1')->references(['id'])->on('action')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_has_car');
    }
};
