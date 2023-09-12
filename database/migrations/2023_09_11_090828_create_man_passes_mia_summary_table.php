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
        Schema::create('man_passes_mia_summary', function (Blueprint $table) {
            $table->unsignedBigInteger('man_id');
            $table->unsignedBigInteger('mia_summary_id')->index('mia_summary_id');

            $table->primary(['man_id', 'mia_summary_id']);

            $table->foreign(['mia_summary_id'], 'man_passes_mia_summary_ibfk_2')->references(['id'])->on('mia_summary')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['man_id'], 'man_passes_mia_summary_ibfk_1')->references(['id'])->on('man')->onUpdate('NO ACTION')->onDelete('NO ACTION');
      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('man_passes_mia_summary');
    }
};
