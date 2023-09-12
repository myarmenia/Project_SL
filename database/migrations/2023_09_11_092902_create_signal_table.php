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
        Schema::create('signal', function (Blueprint $table) {
            $table->id();
            $table->integer('reg_num')->nullable();
            $table->text('content')->nullable();
            $table->integer('check_line')->nullable();
            $table->text('check_status')->nullable();
            $table->unsignedBigInteger('signal_qualification_id')->nullable()->index('fk_signal_signal_qualification1_idx');
            $table->unsignedBigInteger('check_agency_id')->nullable()->index('fk_signal_agency1_idx');
            $table->unsignedBigInteger('check_unit_id')->nullable()->index('fk_signal_agency3');
            $table->unsignedBigInteger('check_subunit_id')->nullable()->index('fk_signal_agency5');
            $table->date('subunit_date')->nullable();
            $table->date('check_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('opened_dou')->nullable();
            $table->unsignedBigInteger('bibliography_id')->nullable()->index('fk_signal_bibliography1_idx');
            $table->unsignedBigInteger('opened_agency_id')->nullable()->index('fk_signal_agency2_idx');
            $table->unsignedBigInteger('opened_unit_id')->nullable()->index('fk_signal_agency6');
            $table->unsignedBigInteger('opened_subunit_id')->nullable()->index('fk_signal_agency4');
            $table->unsignedBigInteger('opened_worker_id')->nullable()->index('fk_signal_worker2_idx');
            $table->unsignedBigInteger('source_resource_id')->nullable()->index('fk_signal_resource1');
            $table->unsignedBigInteger('signal_result_id')->nullable()->index('fk_signal_signal_result1');
            $table->timestamps();

            $table->foreign(['check_subunit_id'], 'fk_signal_agency5')->references(['id'])->on('agency')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['bibliography_id'], 'fk_signal_bibliography1')->references(['id'])->on('bibliography')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['signal_qualification_id'], 'fk_signal_signal_qualification1')->references(['id'])->on('signal_qualification')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['opened_agency_id'], 'fk_signal_agency2')->references(['id'])->on('agency')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['opened_worker_id'], 'fk_signal_worker2')->references(['id'])->on('worker')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['opened_subunit_id'], 'fk_signal_agency4')->references(['id'])->on('agency')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['opened_unit_id'], 'fk_signal_agency6')->references(['id'])->on('agency')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['source_resource_id'], 'fk_signal_resource1')->references(['id'])->on('resource')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['check_agency_id'], 'fk_signal_agency1')->references(['id'])->on('agency')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['signal_result_id'], 'fk_signal_signal_result1')->references(['id'])->on('signal_result')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['check_unit_id'], 'fk_signal_agency3')->references(['id'])->on('agency')->onUpdate('NO ACTION')->onDelete('NO ACTION');
       

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signal');
    }
};
