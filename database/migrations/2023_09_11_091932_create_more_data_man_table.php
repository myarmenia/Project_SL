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
        Schema::create('more_data_man', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->fullText('text');
            $table->unsignedBigInteger('man_id')->index('fk_more_data_man_man1');

            $table->foreign(['man_id'], 'fk_more_data_man_man1')->references(['id'])->on('man')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('more_data_man');
    }
};
