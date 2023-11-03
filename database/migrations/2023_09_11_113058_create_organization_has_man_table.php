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
        Schema::create('organization_has_man', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('man_id')->index('fk_organization_has_man_man1_idx');
            $table->unsignedBigInteger('organization_id')->index('fk_organization_has_man_organization1_idx');
            $table->string('title')->nullable();
            $table->fullText('title');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('period', 45)->nullable();
            $table->fullText('period');

            $table->foreign(['man_id'], 'fk_organization_has_man_man1')->references(['id'])->on('man')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['organization_id'], 'fk_organization_has_man_organization1')->references(['id'])->on('organization')->onUpdate('NO ACTION')->onDelete('NO ACTION');

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
        Schema::dropIfExists('organization_has_man');
    }
};
