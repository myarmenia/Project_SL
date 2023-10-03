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
        Schema::create('man_has_passport', function (Blueprint $table) {
            $table->unsignedBigInteger('man_id')->index('fk_man_has_passport_man1_idx');
            $table->unsignedBigInteger('passport_id')->index('fk_man_has_passport_passport1_idx');

            $table->primary(['man_id', 'passport_id']);

            $table->foreign(['man_id'], 'fk_man_has_passport_man1')->references(['id'])->on('man')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['passport_id'], 'fk_man_has_passport_passport1')->references(['id'])->on('passport')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('man_has_passport');
    }
};
