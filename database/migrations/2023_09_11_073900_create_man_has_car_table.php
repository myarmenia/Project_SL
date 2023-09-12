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
        Schema::create('man_has_car', function (Blueprint $table) {
            $table->unsignedBigInteger('man_id')->index('fk_man_has_car_man1_idx');
            $table->unsignedBigInteger('car_id')->index('fk_man_has_car_car1_idx');
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();

            $table->primary(['man_id', 'car_id']);

            $table->foreign(['car_id'], 'fk_man_has_car_car1')->references(['id'])->on('car')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['man_id'], 'fk_man_has_car_man1')->references(['id'])->on('man')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('man_has_car');
    }
};
