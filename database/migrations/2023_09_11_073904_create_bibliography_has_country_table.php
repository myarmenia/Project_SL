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
        Schema::create('bibliography_has_country', function (Blueprint $table) {
            $table->unsignedBigInteger('bibliography_id');
            $table->unsignedBigInteger('country_id')->index('country_id');

            $table->primary(['bibliography_id', 'country_id']);

            $table->foreign(['country_id'], 'bibliography_has_country_ibfk_2')->references(['id'])->on('country')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['bibliography_id'], 'bibliography_has_country_ibfk_1')->references(['id'])->on('bibliography')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bibliography_has_country');
    }
};
