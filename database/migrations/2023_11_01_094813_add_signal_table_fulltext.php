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
        Schema::table('signal', function (Blueprint $table) {

            $table->fullText('content','content_index');
            $table->fullText('check_status','check_status_index');
            $table->fullText('opened_dou','opened_dou_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('signal', function (Blueprint $table) {

            $table->dropFullText('content_index');
            $table->dropFullText('check_status_index');
            $table->dropFullText('opened_dou_index');
        });
    }
};
