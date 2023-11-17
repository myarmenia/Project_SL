<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('action', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('address', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('car', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('control', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('criminal_case', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('man', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('man_bean_country', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('man_external_sign_has_sign', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('mia_summary', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('phone', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('weapon', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('signal', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('keep_signal', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('email', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('event', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('organization', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('objects_relation', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('bibliography', function (Blueprint $table) {
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
        Schema::table('action', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('address', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('car', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('control', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('criminal_case', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('man', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('man_bean_country', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('man_external_sign_has_sign', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('mia_summary', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('phone', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('weapon', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('signal', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('keep_signal', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('email', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('event', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('organization', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('objects_relation', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('bibliography', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
