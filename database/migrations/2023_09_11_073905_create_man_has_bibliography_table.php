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
        Schema::create('man_has_bibliography', function (Blueprint $table) {
            $table->unsignedBigInteger('man_id')->index('fk_man_has_bibliography_man1_idx');
            $table->unsignedBigInteger('bibliography_id')->index('fk_man_has_bibliography_bibliography1_idx');

            $table->primary(['man_id', 'bibliography_id']);

            $table->foreign(['bibliography_id'], 'fk_man_has_bibliography_bibliography1')->references(['id'])->on('bibliography')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['man_id'], 'fk_man_has_bibliography_man1')->references(['id'])->on('man')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('man_has_bibliography');
    }
};
