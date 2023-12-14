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
        Schema::table('signal_qualification', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('taken_measure', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('control_result', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('signal_result', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('resource', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('organization_category', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('worker_post', function (Blueprint $table) {
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('signal_qualification', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('taken_measure', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('control_result', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('signal_result', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('resource', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('organization_category', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('worker_post', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
