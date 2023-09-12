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
        Schema::create('action_has_material_content', function (Blueprint $table) {
            $table->unsignedBigInteger('action_id')->index('fk_action_has_material_content_action1');
            $table->unsignedBigInteger('material_content_id')->index('fk_action_has_material_content_material_content1');

            // $table->primary(['action_id', 'material_content_id']);

            $table->foreign(['action_id'], 'fk_action_has_material_content_action1')->references(['id'])->on('action')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['material_content_id'], 'fk_action_has_material_content_material_content1')->references(['id'])->on('material_content')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_has_material_content');
    }
};
