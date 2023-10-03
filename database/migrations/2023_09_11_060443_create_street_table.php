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
        Schema::create('street', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('old_name')->nullable();
            $table->unsignedBigInteger('country_id')->nullable()->index('fk_street_country1');
            $table->foreign(['country_id'], 'fk_street_country1')->references(['id'])->on('country')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
        Schema::dropIfExists('street');
    }
};
