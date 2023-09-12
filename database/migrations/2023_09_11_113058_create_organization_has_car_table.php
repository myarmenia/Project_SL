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
        Schema::create('organization_has_car', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id')->index('fk_organization_has_car_organization1');
            $table->unsignedBigInteger('car_id')->index('fk_organization_has_car_car1');

            $table->primary(['organization_id', 'car_id']);

            $table->foreign(['car_id'], 'fk_organization_has_car_car1')->references(['id'])->on('car')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['organization_id'], 'fk_organization_has_car_organization1')->references(['id'])->on('organization')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization_has_car');
    }
};
