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
        Schema::create('man_has_phone', function (Blueprint $table) {
            $table->unsignedBigInteger('man_id')->index('fk_man_has_phone_man1_idx');
            $table->unsignedBigInteger('phone_id')->index('fk_man_has_phone_phone1_idx');
            $table->unsignedBigInteger('character_id')->nullable()->index('fk_man_has_phone_character1_idx');
            $table->timestamp('created_at')->useCurrent();

            $table->primary(['man_id', 'phone_id']);

            $table->foreign(['character_id'], 'fk_man_has_phone_character1')->references(['id'])->on('character')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['phone_id'], 'fk_man_has_phone_phone1')->references(['id'])->on('phone')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['man_id'], 'fk_man_has_phone_man1')->references(['id'])->on('man')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('man_has_phone');
    }
};
