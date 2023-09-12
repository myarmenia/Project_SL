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
        Schema::create('log', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->enum('type', ['login', 'edit', 'delete', 'view', 'print', 'print_joins', 'backup', 'restore', 'search_template', 'smp_search', 'adv_search', 'file_search', 'add', 'report', 'logout', 'fusion', 'optimization']);
            $table->string('tb_name', 100)->nullable();
            $table->integer('tb_id')->nullable();
            $table->integer('second_tb_id')->nullable();
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
        Schema::dropIfExists('log');
    }
};
