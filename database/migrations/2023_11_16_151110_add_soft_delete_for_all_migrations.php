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

        Schema::table('agency', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('action_goal', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('address', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('access_level', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('car', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('car_mark', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('car_category', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('action_qualification', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('aftermath', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('control', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('criminal_case', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('character', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('country', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('country_ate', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('duration', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('doc_category', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('gender', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('goal', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('man', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('nation', function (Blueprint $table) {
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

        Schema::table('party', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('religion', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('relation_type', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('weapon', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('signal', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('sign', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('street', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('terms', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('keep_signal', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('language', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('locality', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('email', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('education', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('event', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('event_qualification', function (Blueprint $table) {
            $table->softDeletes();
        });


        Schema::table('organization', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('objects_relation', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('organization_has_man', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('operation_category', function (Blueprint $table) {
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

        Schema::table('agency', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('action_goal', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('address', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('access_level', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('action_qualification', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('aftermath', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('car', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('car_mark', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('car_category', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('control', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('criminal_case', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('character', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('country', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('country_ate', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('duration', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('doc_category', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('gender', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('goal', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('man', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('nation', function (Blueprint $table) {
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

        Schema::table('party', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('religion', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('relation_type', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('weapon', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('signal', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('sign', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('terms', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('keep_signal', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('language', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('locality', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('email', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('event', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('event_qualification', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('education', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('organization', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('objects_relation', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('organization_has_man', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('operation_category', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('bibliography', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
