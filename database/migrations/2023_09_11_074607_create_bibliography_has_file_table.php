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
        Schema::create('bibliography_has_file', function (Blueprint $table) {
            $table->unsignedBigInteger('bibliography_id')->index('bibliography_id');
            $table->unsignedBigInteger('file_id')->index('file_id');

            $table->foreign(['file_id'], 'bibliography_has_file_ibfk_2')->references(['id'])->on('file')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['bibliography_id'], 'bibliography_has_file_ibfk_1')->references(['id'])->on('bibliography')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bibliography_has_file');
    }
};
