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
        Schema::create('more_data_phone', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->unsignedBigInteger('phone_id')->index('fk_more_data_phone_phone1');

            $table->foreign(['phone_id'], 'fk_more_data_phone_phone1')->references(['id'])->on('phone')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('more_data_phone');
    }
};
