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
        Schema::create('system_learning_options', function (Blueprint $table) {
            $table->id();
            $table->string('name')->uniqie();
            $table->boolean('view_status')->default(1);
            $table->unsignedBigInteger('system_learning_id')->uniqie();
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
        Schema::dropIfExists('system_learning_options');
    }
};
