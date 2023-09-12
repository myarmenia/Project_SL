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
        Schema::create('action_has_qualification', function (Blueprint $table) {
            $table->unsignedBigInteger('action_id');
            $table->unsignedBigInteger('qualification_id')->index('qualification_id');

            $table->primary(['action_id', 'qualification_id']);

            $table->foreign(['qualification_id'], 'action_has_qualification_ibfk_2')->references(['id'])->on('action_qualification')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['action_id'], 'action_has_qualification_ibfk_1')->references(['id'])->on('action')->onUpdate('NO ACTION')->onDelete('NO ACTION');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_has_qualification');
    }
};
