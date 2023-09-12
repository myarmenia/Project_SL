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
        Schema::create('man_external_sign_has_sign', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sign_id')->index('fk_man_external_sign_has_sign_sign1_idx');
            $table->unsignedBigInteger('man_id')->index('fk_man_external_sign_has_sign_man1');
            $table->date('fixed_date')->nullable();
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();

            $table->foreign(['man_id'], 'fk_man_external_sign_has_sign_man1')->references(['id'])->on('man')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['sign_id'], 'fk_man_external_sign_has_sign_sign1')->references(['id'])->on('sign')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('man_external_sign_has_sign');
    }
};
