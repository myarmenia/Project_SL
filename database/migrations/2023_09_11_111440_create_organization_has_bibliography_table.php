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
        Schema::create('organization_has_bibliography', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id')->index('fk_organization_has_bibliography_organization1_idx');
            $table->unsignedBigInteger('bibliography_id')->index('fk_organization_has_bibliography_bibliography1_idx');

            // $table->primary(['organization_id', 'bibliography_id']);

            $table->foreign(['bibliography_id'], 'fk_organization_has_bibliography_bibliography1')->references(['id'])->on('bibliography')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['organization_id'], 'fk_organization_has_bibliography_organization1')->references(['id'])->on('organization')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization_has_bibliography');
    }
};
