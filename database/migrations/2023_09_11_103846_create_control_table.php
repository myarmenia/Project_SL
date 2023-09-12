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
        Schema::create('control', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doc_category_id')->nullable()->index('fk_control_doc_category1_idx');
            $table->date('creation_date')->nullable();
            $table->string('reg_num')->nullable();
            $table->date('reg_date')->nullable();
            $table->string('snb_director')->nullable();
            $table->string('snb_subdirector')->nullable();
            $table->date('resolution_date')->nullable();
            $table->text('resolution')->nullable();
            $table->string('actor_name')->nullable();
            $table->string('sub_actor_name')->nullable();
            $table->unsignedBigInteger('result_id')->nullable()->index('fk_control_result1_idx');
            $table->unsignedBigInteger('bibliography_id')->nullable()->index('fk_control_bibliography1_idx');
            $table->unsignedBigInteger('unit_id')->nullable()->index('fk_control_agency1');
            $table->unsignedBigInteger('act_unit_id')->nullable()->index('fk_control_agency2');
            $table->unsignedBigInteger('sub_act_unit_id')->nullable()->index('fk_control_agency3');

            $table->foreign(['unit_id'], 'fk_control_agency1')->references(['id'])->on('agency')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['sub_act_unit_id'], 'fk_control_agency3')->references(['id'])->on('agency')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['doc_category_id'], 'fk_control_doc_category1')->references(['id'])->on('doc_category')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['act_unit_id'], 'fk_control_agency2')->references(['id'])->on('agency')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['bibliography_id'], 'fk_control_bibliography1')->references(['id'])->on('bibliography')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['result_id'], 'fk_control_result1')->references(['id'])->on('control_result')->onUpdate('NO ACTION')->onDelete('NO ACTION');
       
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
        Schema::dropIfExists('control');
    }
};
