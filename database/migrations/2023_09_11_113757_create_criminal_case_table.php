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
        Schema::create('criminal_case', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->nullable();
            $table->unsignedBigInteger('bibliography_id')->nullable()->index('fk_criminal_case_bibliography1_idx');
            $table->date('opened_date')->nullable();
            $table->string('artical')->nullable();
            $table->unsignedBigInteger('opened_agency_id')->nullable()->index('fk_criminal_case_agency1_idx');
            $table->unsignedBigInteger('opened_unit_id')->nullable()->index('fk_criminal_case_agency2');
            $table->unsignedBigInteger('subunit_id')->nullable()->index('fk_criminal_case_agency3');
            $table->text('character')->nullable();
            $table->unsignedBigInteger('signal_id')->nullable()->index('fk_criminal_case_signal1_idx');
            $table->text('opened_dou')->nullable();
            $table->unsignedBigInteger('worker_id')->nullable()->index('fk_criminal_case_worker1');

            $table->foreign(['opened_agency_id'], 'fk_criminal_case_agency1')->references(['id'])->on('agency')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['subunit_id'], 'fk_criminal_case_agency3')->references(['id'])->on('agency')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['signal_id'], 'fk_criminal_case_signal1')->references(['id'])->on('signal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['opened_unit_id'], 'fk_criminal_case_agency2')->references(['id'])->on('agency')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['bibliography_id'], 'fk_criminal_case_bibliography1')->references(['id'])->on('bibliography')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['worker_id'], 'fk_criminal_case_worker1')->references(['id'])->on('worker')->onUpdate('NO ACTION')->onDelete('NO ACTION');
       
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
        Schema::dropIfExists('criminal_case');
    }
};
