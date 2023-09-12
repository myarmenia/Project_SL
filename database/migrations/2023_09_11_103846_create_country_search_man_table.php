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
        Schema::create('country_search_man', function (Blueprint $table) {
            $table->unsignedBigInteger('country_id')->index('fk_country_has_man_country1_idx');
            $table->unsignedBigInteger('man_id')->index('fk_country_has_man_man1_idx');

            $table->primary(['country_id', 'man_id']);

            $table->foreign(['country_id'], 'fk_country_has_man_country1')->references(['id'])->on('country')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['man_id'], 'fk_country_has_man_man1')->references(['id'])->on('man')->onUpdate('NO ACTION')->onDelete('NO ACTION');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country_search_man');
    }
};
