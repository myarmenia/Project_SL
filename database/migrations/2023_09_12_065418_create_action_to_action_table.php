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
        Schema::create('action_to_action', function (Blueprint $table) {
            $table->unsignedBigInteger('action_id1');
            $table->unsignedBigInteger('action_id2')->index('action_id2');

            $table->primary(['action_id1', 'action_id2']);

            $table->foreign(['action_id2'], 'action_to_action_ibfk_2')->references(['id'])->on('action')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['action_id1'], 'action_to_action_ibfk_1')->references(['id'])->on('action')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_to_action');
    }
};
