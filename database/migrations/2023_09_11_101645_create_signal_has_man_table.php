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
        Schema::create('signal_has_man', function (Blueprint $table) {
            $table->unsignedBigInteger('signal_id')->index('fk_signal_has_man_signal1_idx');
            $table->unsignedBigInteger('man_id')->index('fk_signal_has_man_man1_idx');

            $table->primary(['signal_id', 'man_id']);

            $table->foreign(['signal_id'], 'fk_signal_has_man_signal1')->references(['id'])->on('signal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['man_id'], 'fk_signal_has_man_man1')->references(['id'])->on('man')->onUpdate('NO ACTION')->onDelete('NO ACTION');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signal_has_man');
    }
};
