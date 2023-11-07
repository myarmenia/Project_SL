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
        Schema::table('mia_summary', function (Blueprint $table) {
            $table->fullText('content','mia_summary_content_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mia_summary', function (Blueprint $table) {
            $table->dropFullText('mia_summary_content_index');
        });
    }
};
