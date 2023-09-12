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
        Schema::create('man_to_man', function (Blueprint $table) {
            $table->unsignedBigInteger('man_id1');
            $table->unsignedBigInteger('man_id2')->index('man_id2');

            $table->primary(['man_id1', 'man_id2']);

            $table->foreign(['man_id2'], 'man_to_man_ibfk_2')->references(['id'])->on('man')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['man_id1'], 'man_to_man_ibfk_1')->references(['id'])->on('man')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('man_to_man');
    }
};
