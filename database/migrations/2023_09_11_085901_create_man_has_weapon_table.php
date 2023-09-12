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
        Schema::create('man_has_weapon', function (Blueprint $table) {
            $table->unsignedBigInteger('man_id')->index('fk_man_has_weapon_man1_idx');
            $table->unsignedBigInteger('weapon_id')->index('fk_man_has_weapon_weapon1_idx');
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();

            $table->primary(['man_id', 'weapon_id']);

            $table->foreign(['man_id'], 'fk_man_has_weapon_man1')->references(['id'])->on('man')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['weapon_id'], 'fk_man_has_weapon_weapon1')->references(['id'])->on('weapon')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('man_has_weapon');
    }
};
