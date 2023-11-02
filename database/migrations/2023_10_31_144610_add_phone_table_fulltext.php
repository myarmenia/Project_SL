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
        Schema::table('phone', function (Blueprint $table) {
            $table->fullText('number','phone_number_index');
            $table->fullText('more_data','phone_more_data_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phone', function (Blueprint $table) {
            $table->dropFullText('phone_number_index');
            $table->dropFullText('phone_more_data_index');
        });
    }
};
