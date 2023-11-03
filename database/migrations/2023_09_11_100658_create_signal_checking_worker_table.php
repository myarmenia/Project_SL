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
        Schema::create('signal_checking_worker', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('signal_id')->index('signal_id');
            $table->string('worker');
            $table->fullText('worker');

            $table->foreign(['signal_id'], 'signal_checking_worker_ibfk_1')->references(['id'])->on('signal')->onUpdate('NO ACTION')->onDelete('NO ACTION');

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
        Schema::dropIfExists('signal_checking_worker');
    }
};
