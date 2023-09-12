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
        Schema::create('man_passed_by_signal', function (Blueprint $table) {
            $table->unsignedBigInteger('signal_id')->index('fk_signal_has_man1_signal1');
            $table->unsignedBigInteger('man_id')->index('fk_signal_has_man1_man1');

            $table->primary(['signal_id', 'man_id']);

            $table->foreign(['signal_id'], 'fk_signal_has_man1_signal1')->references(['id'])->on('signal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['man_id'], 'fk_signal_has_man1_man1')->references(['id'])->on('man')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('man_passed_by_signal');
    }
};
