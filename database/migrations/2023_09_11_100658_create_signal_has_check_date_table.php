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
        Schema::create('signal_has_check_date', function (Blueprint $table) {
            $table->unsignedBigInteger('signal_id')->index('fk_signal_has_check_date_signal1_idx');
            $table->unsignedBigInteger('check_date_id')->index('fk_signal_has_check_date_check_date1_idx');

            $table->primary(['signal_id', 'check_date_id']);

            $table->foreign(['signal_id'], 'fk_signal_has_check_date_signal1')->references(['id'])->on('signal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['check_date_id'], 'fk_signal_has_check_date_check_date1')->references(['id'])->on('check_date')->onUpdate('NO ACTION')->onDelete('NO ACTION');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signal_has_check_date');
    }
};
