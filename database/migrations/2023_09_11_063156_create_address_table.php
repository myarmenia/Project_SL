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
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id')->nullable()->index('fk_address_country1_idx');
            $table->unsignedBigInteger('region_id')->nullable()->index('fk_address_region1_idx');
            $table->unsignedBigInteger('locality_id')->nullable()->index('fk_address_locality1_idx');
            $table->unsignedBigInteger('street_id')->nullable()->index('fk_address_street1_idx');
            $table->unsignedBigInteger('city_id')->nullable()->index('fk_address_city1');
            $table->string('track')->nullable();
            $table->string('home_num')->nullable();
            $table->string('housing_num')->nullable();
            $table->string('apt_num')->nullable();
            $table->unsignedBigInteger('country_ate_id')->nullable()->index('fk_address_country_ate1');

            $table->foreign(['city_id'], 'fk_address_city1')->references(['id'])->on('city')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['country_ate_id'], 'fk_address_country_ate1')->references(['id'])->on('country_ate')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['region_id'], 'fk_address_region1')->references(['id'])->on('region')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['country_id'], 'fk_address_country1')->references(['id'])->on('country')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['locality_id'], 'fk_address_locality1')->references(['id'])->on('locality')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['street_id'], 'fk_address_street1')->references(['id'])->on('street')->onUpdate('NO ACTION')->onDelete('NO ACTION');

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
        Schema::dropIfExists('address');
    }
};
