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
        Schema::create('organization_has_address', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id')->index('fk_organization_has_address_organization1_idx');
            $table->unsignedBigInteger('address_id')->index('fk_organization_has_address_address1_idx');
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->primary(['organization_id', 'address_id']);

            $table->foreign(['address_id'], 'fk_organization_has_address_address1')->references(['id'])->on('address')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['organization_id'], 'fk_organization_has_address_organization1')->references(['id'])->on('organization')->onUpdate('NO ACTION')->onDelete('NO ACTION');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization_has_address');
    }
};
