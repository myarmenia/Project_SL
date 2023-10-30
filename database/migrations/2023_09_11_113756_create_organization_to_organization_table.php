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
        Schema::create('organization_to_organization', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id1');
            $table->unsignedBigInteger('organization_id2')->index('organization_id2');

            $table->primary(['organization_id1', 'organization_id2']);

            $table->foreign(['organization_id1'], 'organization_to_organization_ibfk_1')->references(['id'])->on('organization')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['organization_id2'], 'organization_to_organization_ibfk_2')->references(['id'])->on('organization')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization_to_organization');
    }
};
