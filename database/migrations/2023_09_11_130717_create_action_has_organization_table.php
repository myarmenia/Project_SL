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
        Schema::create('action_has_organization', function (Blueprint $table) {
            $table->unsignedBigInteger('action_id')->index('fk_action_has_organization_action1_idx');
            $table->unsignedBigInteger('organization_id')->index('fk_action_has_organization_organization1_idx');

            // $table->primary(['action_id', 'organization_id']);

            $table->foreign(['action_id'], 'fk_action_has_organization_action1')->references(['id'])->on('action')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['organization_id'], 'fk_action_has_organization_organization1')->references(['id'])->on('organization')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_has_organization');
    }
};
