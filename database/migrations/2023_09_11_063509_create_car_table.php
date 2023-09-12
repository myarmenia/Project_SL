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
        Schema::create('car', function (Blueprint $table) {
            $table->id();
            $table->string('number')->nullable();
            $table->string('note')->nullable();
            $table->unsignedBigInteger('category_id')->nullable()->index('fk_car_car_category1_idx');
            $table->unsignedBigInteger('mark_id')->nullable()->index('fk_car_car_mark1_idx');
            $table->unsignedBigInteger('color_id')->nullable()->index('fk_car_color1_idx');
            $table->integer('count')->nullable();

            $table->foreign(['mark_id'], 'fk_car_car_mark1')->references(['id'])->on('car_mark')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['category_id'], 'fk_car_car_category1')->references(['id'])->on('car_category')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['color_id'], 'fk_car_color1')->references(['id'])->on('color')->onUpdate('NO ACTION')->onDelete('NO ACTION');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car');
    }
};
