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
        Schema::create('car_has_address', function (Blueprint $table) {
            $table->unsignedBigInteger('car_id')->index('fk_car_has_address_car1');
            $table->unsignedBigInteger('address_id')->index('fk_car_has_address_address1');

            $table->foreign(['car_id'], 'fk_car_has_address_car1')->references(['id'])->on('car')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['address_id'], 'fk_car_has_address_address1')->references(['id'])->on('address')->onUpdate('NO ACTION')->onDelete('NO ACTION');

            $table->primary(['car_id', 'address_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_has_address');
    }
};
