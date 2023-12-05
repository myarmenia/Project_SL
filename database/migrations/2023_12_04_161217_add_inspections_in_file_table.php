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
        Schema::table('file', function (Blueprint $table) {
            $table->string('file_lang')->nullable()->after('show_folder');
            $table->boolean('file_phonetic')->default(false)->after('file_lang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('file', function (Blueprint $table) {
            Schema::dropColumn('file_phonetic');
            Schema::dropColumn('file_lang');
        });
    }
};
