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
        Schema::table('address', function (Blueprint $table) {

            $table->fullText('track','address_address_index');
            $table->fullText('home_num','address_home_num_index');
            $table->fullText('housing_num','address_housing_num_index');
            $table->fullText('apt_num','address_apt_num_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('address', function (Blueprint $table) {

            $table->dropFullText('address_address_index');
            $table->dropFullText('address_home_num_index');
            $table->dropFullText('address_housing_num_index');
            $table->dropFullText('address_apt_num_index');
        });
    }
};
