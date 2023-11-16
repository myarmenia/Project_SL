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
        Schema::table('control', function (Blueprint $table) {
            $table->fullText('reg_num','reg_num_index');
            $table->fullText('snb_director','snb_director_idex');
            $table->fullText('snb_subdirector','snb_subdirector_index');
            $table->fullText('resolution','resolution_index');
            $table->fullText('actor_name','actor_name_index');
            $table->fullText('sub_actor_name','sub_actor_name_index');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('control', function (Blueprint $table) {

            $table->dropFullText('reg_num_index');
            $table->dropFullText('snb_director_idex');
            $table->dropFullText('snb_subdirector_index');
            $table->dropFullText('resolution_index');
            $table->dropFullText('actor_name_index');
            $table->dropFullText('sub_actor_name_index');
        });
    }
};
