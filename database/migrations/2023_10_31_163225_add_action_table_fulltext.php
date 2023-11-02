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
        Schema::table('action', function (Blueprint $table) {

            $table->fullText('source','action_source_index');
            $table->fullText('opened_dou','action_opened_dou_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('action', function (Blueprint $table) {

            $table->dropFullText('action_source_index');
            $table->dropFullText('action_opened_dou_index');

        });
    }
};
