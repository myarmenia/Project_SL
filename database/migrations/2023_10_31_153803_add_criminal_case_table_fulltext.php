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
        Schema::table('criminal_case', function (Blueprint $table) {

            $table->fullText('artical','criminal_case_artical_index');
            $table->fullText('character','criminal_case_character_index');
            $table->fullText('opened_dou','criminal_case_opened_dou_index');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('criminal_case', function (Blueprint $table) {

            $table->dropFullText('criminal_case_artical_index');
            $table->dropFullText('criminal_case_character_index');
            $table->dropFullText('criminal_case_opened_dou_index');
        });
    }
};
