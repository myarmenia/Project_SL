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
        Schema::create('man_has_party', function (Blueprint $table) {
            $table->unsignedBigInteger('man_id')->index('fk_man_has_party_man1_idx');
            $table->unsignedBigInteger('party_id')->index('fk_man_has_party_party1_idx');
            $table->timestamp('created_at')->nullable()->useCurrent();

            $table->primary(['man_id', 'party_id']);

            $table->foreign(['man_id'], 'fk_man_has_party_man1')->references(['id'])->on('man')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['party_id'], 'fk_man_has_party_party1')->references(['id'])->on('party')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('man_has_party');
    }
};
