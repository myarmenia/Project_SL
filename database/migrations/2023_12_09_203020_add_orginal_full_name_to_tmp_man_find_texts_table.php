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
        Schema::table('tmp_man_find_texts', function (Blueprint $table) {
            $table->string('orginal_name')->nullable()->after('patronymic');
            $table->string('orginal_surname')->nullable()->after('orginal_name');
            $table->string('orginal_patronymic')->nullable()->after('orginal_surname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tmp_man_find_texts', function (Blueprint $table) {
            $table->dropColumn('orginal_name');
            $table->dropColumn('orginal_surname');
            $table->dropColumn('orginal_patronymic');
        });
    }
};
