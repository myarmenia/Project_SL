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
        Schema::create('criminal_case_extracted_criminal_case', function (Blueprint $table) {
            $table->unsignedBigInteger('criminal_case_id')->index('fk_criminal_case_has_criminal_case_criminal_case3_idx');
            $table->unsignedBigInteger('criminal_case_id1')->index('fk_criminal_case_has_criminal_case_criminal_case4_idx');


            $table->foreign(['criminal_case_id'], 'fk_criminal_case_has_criminal_case_criminal_case3')->references(['id'])->on('criminal_case')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['criminal_case_id1'], 'fk_criminal_case_has_criminal_case_criminal_case4')->references(['id'])->on('criminal_case')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('criminal_case_extracted_criminal_case');
    }
};
