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
        Schema::table('bibliography', function (Blueprint $table) {

            $table->fullText('worker_name','bibliography_worker_name_index');
            $table->fullText('reg_number','bibliography_reg_number_index');
            $table->fullText('source_address','bibliography_source_address_index');
            $table->fullText('short_desc','bibliography_short_desc_index');
         //   $table->fullText('related_year','bibliography_related_year_index');
            $table->fullText('source','bibliography_source_index');
            $table->fullText('theme','bibliography_theme_index');
            $table->fullText('title','bibliography_title_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bibliography', function (Blueprint $table) {

            $table->dropFullText('bibliography_worker_name_index');
            $table->dropFullText('bibliography_reg_number_index');
            $table->dropFullText('bibliography_source_address_index');
            $table->dropFullText('bibliography_short_desc_index');
          //  $table->dropFullText('bibliography_related_year_index');
            $table->dropFullText('bibliography_source_index');
            $table->dropFullText('bibliography_theme_index');
            $table->dropFullText('bibliography_title_index');
        });
    }
};
