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
        Schema::create('organization_passes_mia_summary', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id')->index('fk_organization_has_mia_summary_organization1_idx');
            $table->unsignedBigInteger('mia_summary_id')->index('fk_organization_has_mia_summary_mia_summary1_idx');

            // $table->primary(['organization_id', 'mia_summary_id']);

            $table->foreign(['mia_summary_id'], 'fk_organization_has_mia_summary_mia_summary1')->references(['id'])->on('mia_summary')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['organization_id'], 'fk_organization_has_mia_summary_organization1')->references(['id'])->on('organization')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization_passes_mia_summary');
    }
};
