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
        Schema::create('man_has_nickname', function (Blueprint $table) {
            $table->unsignedBigInteger('man_id')->index('fk_man_has_nickname_man1_idx');
            $table->unsignedBigInteger('nickname_id')->index('fk_man_has_nickname_nickname1_idx');

            $table->primary(['man_id', 'nickname_id']);

            $table->foreign(['man_id'], 'fk_man_has_nickname_man1')->references(['id'])->on('man')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['nickname_id'], 'fk_man_has_nickname_nickname1')->references(['id'])->on('nickname')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('man_has_nickname');
    }
};
