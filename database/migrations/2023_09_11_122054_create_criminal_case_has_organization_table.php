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
        Schema::create('criminal_case_has_organization', function (Blueprint $table) {
            $table->unsignedBigInteger('criminal_case_id')->index('fk_criminal_case_has_organization_criminal_case1_idx');
            $table->unsignedBigInteger('organization_id')->index('fk_criminal_case_has_organization_organization1_idx');


            $table->foreign(['criminal_case_id'], 'fk_criminal_case_has_organization_criminal_case1')->references(['id'])->on('criminal_case')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['organization_id'], 'fk_criminal_case_has_organization_organization1')->references(['id'])->on('organization')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('criminal_case_has_organization');
    }
};
