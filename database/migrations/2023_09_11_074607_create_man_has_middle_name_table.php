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
        Schema::create('man_has_middle_name', function (Blueprint $table) {
            $table->unsignedBigInteger('man_id')->index('fk_man_has_middle_name_man1');
            $table->unsignedBigInteger('middle_name_id')->index('fk_man_has_middle_name_middle_name1');

            $table->primary(['man_id', 'middle_name_id']);

            $table->foreign(['man_id'], 'fk_man_has_middle_name_man1')->references(['id'])->on('man')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['middle_name_id'], 'fk_man_has_middle_name_middle_name1')->references(['id'])->on('middle_name')->onUpdate('NO ACTION')->onDelete('NO ACTION');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('man_has_middle_name');
    }
};
