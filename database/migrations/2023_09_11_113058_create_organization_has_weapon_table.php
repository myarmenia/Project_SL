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
        Schema::create('organization_has_weapon', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id')->index('fk_organization_has_weapon_organization1_idx');
            $table->unsignedBigInteger('weapon_id')->index('fk_organization_has_weapon_weapon1_idx');
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();

            $table->primary(['organization_id', 'weapon_id']);

            $table->foreign(['organization_id'], 'fk_organization_has_weapon_organization1')->references(['id'])->on('organization')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['weapon_id'], 'fk_organization_has_weapon_weapon1')->references(['id'])->on('weapon')->onUpdate('NO ACTION')->onDelete('NO ACTION');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization_has_weapon');
    }
};
