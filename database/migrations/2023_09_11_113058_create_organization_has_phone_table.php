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
        Schema::create('organization_has_phone', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id')->index('fk_organization_has_phone_organization1_idx');
            $table->unsignedBigInteger('phone_id')->index('fk_organization_has_phone_phone1_idx');
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();
            $table->unsignedBigInteger('character_id')->nullable()->index('fk_organization_has_phone_character1');

            $table->primary(['organization_id', 'phone_id']);

            $table->foreign(['character_id'], 'fk_organization_has_phone_character1')->references(['id'])->on('character')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['phone_id'], 'fk_organization_has_phone_phone1')->references(['id'])->on('phone')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['organization_id'], 'fk_organization_has_phone_organization1')->references(['id'])->on('organization')->onUpdate('NO ACTION')->onDelete('NO ACTION');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization_has_phone');
    }
};
