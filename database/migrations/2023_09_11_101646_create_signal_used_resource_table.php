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
        Schema::create('signal_used_resource', function (Blueprint $table) {
            $table->unsignedBigInteger('signal_id')->index('fk_signal_has_resource_signal1_idx');
            $table->unsignedBigInteger('resource_id')->index('fk_signal_has_resource_resource1_idx');

            $table->primary(['signal_id', 'resource_id']);

            $table->foreign(['signal_id'], 'fk_signal_has_resource_signal1')->references(['id'])->on('signal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['resource_id'], 'fk_signal_has_resource_resource1')->references(['id'])->on('resource')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signal_used_resource');
    }
};
