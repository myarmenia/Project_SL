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
        Schema::create('learning_sysytems', function (Blueprint $table) {
            $table->id();
            $table->string('en')->nullable();
            $table->string('ru')->nullable();
            $table->string('hy')->nullable();
            $table->string('type');
            $table->string('learning_type');
            $table->boolean('status');
            $table->softDeletes();
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
        Schema::dropIfExists('learning_sysytems');
    }
};
