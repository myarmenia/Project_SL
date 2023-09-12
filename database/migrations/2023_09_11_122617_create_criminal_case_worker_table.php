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
        Schema::create('criminal_case_worker', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('criminal_case_id')->index('criminal_case_id');
            $table->string('worker');

            $table->foreign(['criminal_case_id'], 'criminal_case_worker_ibfk_1')->references(['id'])->on('criminal_case')->onUpdate('NO ACTION')->onDelete('NO ACTION');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('criminal_case_worker');
    }
};
