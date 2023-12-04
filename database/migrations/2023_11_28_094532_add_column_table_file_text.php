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
        Schema::table('file_texts', function (Blueprint $table) {

            $table->tinyInteger('status')->default(0);
            $table->string('search_string')->nullable()->default(null);
            $table->fullText('content','text_search');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('file_texts', function (Blueprint $table) {
            $table->dropColumn(['status', 'search_string']);
            $table->dropFullText('text_search');
        });
    }
};
