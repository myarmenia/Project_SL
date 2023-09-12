<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_uploads', function (Blueprint $table) {
            $table->unsignedTinyInteger('birth_day')->nullable()->after('birthday');
            $table->unsignedTinyInteger('birth_month')->nullable()->after('birth_day');
            $table->year('birth_year')->nullable()->after('birth_month');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_uploads', function (Blueprint $table) {
            $table->dropColumn('birth_day');
            $table->dropColumn('birth_month');
            $table->dropColumn('birth_year');
        });
    }
};