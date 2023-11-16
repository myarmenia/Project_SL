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
        Schema::create('bibliography', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->unsignedBigInteger('user_id')->index('fk_bibliography_users_idx');
            $table->unsignedBigInteger('category_id')->nullable()->index('fk_bibliography_doc_category1_idx');
            $table->unsignedBigInteger('access_level_id')->nullable()->index('fk_bibliography_access_level1_idx');
            $table->unsignedBigInteger('source_agency_id')->nullable()->index('fk_bibliography_agency1_idx');
            $table->unsignedBigInteger('from_agency_id')->nullable()->index('fk_bibliography_agency2_idx');
            $table->string('source')->nullable();
            $table->string('short_desc')->nullable();
            $table->string('related_year')->nullable();
            $table->unsignedBigInteger('country_id')->nullable()->index('fk_bibliography_country1_idx');
            $table->string('theme')->nullable();
            $table->text('source_address')->nullable();
            $table->text('worker_name')->nullable();
            $table->string('reg_number')->nullable();
            $table->date('reg_date')->nullable();
            $table->boolean('video')->default(false);

            $table->foreign(['category_id'], 'fk_bibliography_doc_category1')->references(['id'])->on('doc_category')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['source_agency_id'], 'fk_bibliography_agency1')->references(['id'])->on('agency')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['country_id'], 'fk_bibliography_country1')->references(['id'])->on('country')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_id'], 'fk_bibliography_users')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['access_level_id'], 'fk_bibliography_access_level1')->references(['id'])->on('access_level')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['from_agency_id'], 'fk_bibliography_agency2')->references(['id'])->on('agency')->onUpdate('NO ACTION')->onDelete('NO ACTION');

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
        Schema::dropIfExists('bibliography');
    }
};
