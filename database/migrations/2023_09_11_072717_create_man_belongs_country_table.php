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
        Schema::create('man_belongs_country', function (Blueprint $table) {
            $table->unsignedBigInteger('man_id')->index('fk_man_has_country_man2_idx');
            $table->unsignedBigInteger('country_id')->index('fk_man_has_country_country2_idx');
            $table->primary(['man_id', 'country_id']);

            $table->foreign(['country_id'], 'fk_man_has_country_country2')->references(['id'])->on('country')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['man_id'], 'fk_man_has_country_man2')->references(['id'])->on('man')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('man_belongs_country');
    }
};
