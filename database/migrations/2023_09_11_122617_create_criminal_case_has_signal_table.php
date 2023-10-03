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
        Schema::create('criminal_case_has_signal', function (Blueprint $table) {
            $table->unsignedBigInteger('criminal_case_id');
            $table->unsignedBigInteger('signal_id')->index('signal_id');

            $table->foreign(['criminal_case_id'], 'criminal_case_has_signal_ibfk_1')->references(['id'])->on('criminal_case')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['signal_id'], 'criminal_case_has_signal_ibfk_2')->references(['id'])->on('signal')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('criminal_case_has_signal');
    }
};
