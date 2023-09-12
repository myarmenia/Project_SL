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
        Schema::create('criminal_case_has_man', function (Blueprint $table) {
            $table->unsignedBigInteger('criminal_case_id')->index('fk_criminal_case_has_man_criminal_case1_idx');
            $table->unsignedBigInteger('man_id')->index('fk_criminal_case_has_man_man1_idx');

            $table->primary(['criminal_case_id', 'man_id']);

            $table->foreign(['criminal_case_id'], 'fk_criminal_case_has_man_criminal_case1')->references(['id'])->on('criminal_case')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['man_id'], 'fk_criminal_case_has_man_man1')->references(['id'])->on('man')->onUpdate('NO ACTION')->onDelete('NO ACTION');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('criminal_case_has_man');
    }
};
