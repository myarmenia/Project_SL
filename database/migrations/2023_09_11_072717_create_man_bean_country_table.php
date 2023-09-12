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
        Schema::create('man_bean_country', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('man_id')->nullable()->index('fk_man_has_country_man1_idx');
            $table->unsignedBigInteger('country_ate_id')->nullable()->index('fk_man_bean_country_country_ate1');
            $table->unsignedBigInteger('goal_id')->nullable()->index('fk_man_bean_country_goal1_idx');
            $table->date('entry_date')->nullable();
            $table->date('exit_date')->nullable();
            $table->unsignedBigInteger('region_id')->nullable()->index('fk_man_bean_country_region1');
            $table->unsignedBigInteger('locality_id')->nullable()->index('fk_man_bean_country_locality1');

            $table->foreign(['country_ate_id'], 'fk_man_bean_country_country_ate1')->references(['id'])->on('country_ate')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['locality_id'], 'fk_man_bean_country_locality1')->references(['id'])->on('locality')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['man_id'], 'fk_man_has_country_man1')->references(['id'])->on('man')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['goal_id'], 'fk_man_bean_country_goal1')->references(['id'])->on('goal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['region_id'], 'fk_man_bean_country_region1')->references(['id'])->on('region')->onUpdate('NO ACTION')->onDelete('NO ACTION');

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
        Schema::dropIfExists('man_bean_country');
    }
};
