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
        Schema::create('organization_checked_by_signal', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id')->index('fk_organization_has_signal_organization1_idx');
            $table->unsignedBigInteger('signal_id')->index('fk_organization_has_signal_signal1_idx');

            $table->primary(['organization_id', 'signal_id']);

            $table->foreign(['organization_id'], 'fk_organization_has_signal_organization1')->references(['id'])->on('organization')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['signal_id'], 'fk_organization_has_signal_signal1')->references(['id'])->on('signal')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization_checked_by_signal');
    }
};
