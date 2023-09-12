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
        Schema::create('man_has_address', function (Blueprint $table) {
            $table->unsignedBigInteger('man_id')->index('fk_man_has_address_man1_idx');
            $table->unsignedBigInteger('address_id')->index('fk_man_has_address_address1_idx');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->primary(['man_id', 'address_id']);

            $table->foreign(['address_id'], 'fk_man_has_address_address1')->references(['id'])->on('address')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['man_id'], 'fk_man_has_address_man1')->references(['id'])->on('man')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('man_has_address');
    }
};
