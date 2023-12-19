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
        Schema::table('organization', function (Blueprint $table) {

            $table->fullText('name','org_name_index');
            $table->fullText('attension','org_attension_index');
            $table->fullText('opened_dou','org_opened_dou_index');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organization', function (Blueprint $table) {

            $table->dropFullText('org_name_index');
            $table->dropFullText('org_attension_index');
            $table->dropFullText('org_opened_dou_index');
        });
    }
};
