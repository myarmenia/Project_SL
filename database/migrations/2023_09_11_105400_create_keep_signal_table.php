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
        Schema::create('keep_signal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('signal_id')->nullable()->index('fk_conduct_signal_signal1');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('pass_date')->nullable();
            $table->unsignedBigInteger('pased_sub_unit')->nullable()->index('pased_sub_unit');
            $table->unsignedBigInteger('agency_id')->nullable()->index('fk_conduct_signal_agency1');
            $table->unsignedBigInteger('unit_id')->nullable()->index('fk_conduct_signal_agency2');
            $table->unsignedBigInteger('sub_unit_id')->nullable()->index('fk_conduct_signal_agency3');

            $table->foreign(['pased_sub_unit'], 'keep_signal_ibfk_1')->references(['id'])->on('agency')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['unit_id'], 'fk_conduct_signal_agency2')->references(['id'])->on('agency')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['signal_id'], 'fk_conduct_signal_signal1')->references(['id'])->on('signal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['agency_id'], 'fk_conduct_signal_agency1')->references(['id'])->on('agency')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['sub_unit_id'], 'fk_conduct_signal_agency3')->references(['id'])->on('agency')->onUpdate('NO ACTION')->onDelete('NO ACTION');
       
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
        Schema::dropIfExists('keep_signal');
    }
};
