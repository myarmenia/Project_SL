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
        Schema::create('event_has_criminal_case', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('criminal_case_id')->index('criminal_case_id');

            $table->primary(['event_id', 'criminal_case_id']);

            $table->foreign(['criminal_case_id'], 'event_has_criminal_case_ibfk_2')->references(['id'])->on('criminal_case')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['event_id'], 'event_has_criminal_case_ibfk_1')->references(['id'])->on('event')->onUpdate('NO ACTION')->onDelete('NO ACTION');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_has_criminal_case');
    }
};
