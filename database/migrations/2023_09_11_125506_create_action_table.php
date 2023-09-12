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
        Schema::create('action', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->unsignedBigInteger('duration_id')->nullable()->index('fk_action_duration1_idx');
            $table->unsignedBigInteger('goal_id')->nullable()->index('fk_action_action_goal1_idx');
            $table->unsignedBigInteger('terms_id')->nullable()->index('fk_action_terms1_idx');
            $table->unsignedBigInteger('aftermath_id')->nullable()->index('fk_action_aftermath1_idx');
            $table->unsignedBigInteger('related_action_id')->nullable()->index('fk_action_action1_idx');
            $table->unsignedBigInteger('bibliography_id')->nullable()->index('fk_action_bibliography1_idx');
            $table->string('source')->nullable();
            $table->unsignedBigInteger('address_id')->nullable()->index('fk_action_address1_idx');
            $table->unsignedBigInteger('opened_criminal_case_id')->nullable()->index('fk_action_criminal_case1_idx');
            $table->string('opened_dou')->nullable();
            $table->unsignedBigInteger('action_qualification_id')->nullable()->index('fk_action_action_qualification1');

            $table->foreign(['aftermath_id'], 'fk_action_aftermath1')->references(['id'])->on('aftermath')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['opened_criminal_case_id'], 'fk_action_criminal_case1')->references(['id'])->on('criminal_case')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['terms_id'], 'fk_action_terms1')->references(['id'])->on('terms')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['goal_id'], 'fk_action_action_goal1')->references(['id'])->on('action_goal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['address_id'], 'fk_action_address1')->references(['id'])->on('address')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['bibliography_id'], 'fk_action_bibliography1')->references(['id'])->on('bibliography')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['duration_id'], 'fk_action_duration1')->references(['id'])->on('duration')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['related_action_id'], 'fk_action_action1')->references(['id'])->on('action')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['action_qualification_id'], 'fk_action_action_qualification1')->references(['id'])->on('action_qualification')->onUpdate('NO ACTION')->onDelete('NO ACTION');
       
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
        Schema::dropIfExists('action');
    }
};
