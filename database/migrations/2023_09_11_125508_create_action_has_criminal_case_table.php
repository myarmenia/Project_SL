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
        Schema::create('action_has_criminal_case', function (Blueprint $table) {
            $table->unsignedBigInteger('action_id');
            $table->unsignedBigInteger('criminal_case_id')->index('criminal_case_id');

            $table->primary(['action_id', 'criminal_case_id']);

            $table->foreign(['criminal_case_id'], 'action_has_criminal_case_ibfk_2')->references(['id'])->on('criminal_case')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['action_id'], 'action_has_criminal_case_ibfk_1')->references(['id'])->on('action')->onUpdate('NO ACTION')->onDelete('NO ACTION');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_has_criminal_case');
    }
};
