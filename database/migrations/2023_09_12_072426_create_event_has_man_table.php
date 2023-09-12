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
        Schema::create('event_has_man', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id')->index('fk_event_has_man_event1_idx');
            $table->unsignedBigInteger('man_id')->index('fk_event_has_man_man1_idx');

            $table->primary(['event_id', 'man_id']);

            $table->foreign(['man_id'], 'fk_event_has_man_man1')->references(['id'])->on('man')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['event_id'], 'fk_event_has_man_event1')->references(['id'])->on('event')->onUpdate('NO ACTION')->onDelete('NO ACTION');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_has_man');
    }
};
