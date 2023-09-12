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
        Schema::create('objects_relation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('relation_type_id')->nullable()->index('fk_objects_relation_relation_type1_idx');
            $table->integer('first_object_id');
            $table->integer('second_object_id');
            $table->string('first_object_type', 25);
            $table->string('second_obejct_type', 25);

            $table->foreign(['relation_type_id'], 'fk_objects_relation_relation_type1')->references(['id'])->on('relation_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objects_relation');
    }
};
