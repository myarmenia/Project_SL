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
        Schema::table('weapon', function (Blueprint $table) {

            $table->fullText('category','weapon_category_index');
            $table->fullText('view','weapon_view_index');
            $table->fullText('type','weapon_type_index');
            $table->fullText('model','weapon_model_index');
            $table->fullText('reg_num','weapon_reg_num_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weapon', function (Blueprint $table) {

            $table->dropFullText('weapon_category_index');
            $table->dropFullText('weapon_view_index');
            $table->dropFullText('weapon_type_index');
            $table->dropFullText('weapon_model_index');
            $table->dropFullText('weapon_reg_num_index');
        });
    }
};
