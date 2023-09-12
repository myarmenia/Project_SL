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
        Schema::create('organization', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id')->nullable()->index('fk_organization_country1_idx');
            $table->string('name')->nullable();
            $table->date('reg_date')->nullable();
            $table->unsignedBigInteger('address_id')->nullable()->index('fk_organization_address1_idx');
            $table->unsignedBigInteger('known_as_organization_id')->nullable()->index('fk_organization_organization1_idx');
            $table->unsignedBigInteger('category_id')->nullable()->index('fk_organization_organization_category1_idx');
            $table->integer('employers_count')->nullable();
            $table->string('attension')->nullable();
            $table->string('opened_dou')->nullable();
            $table->unsignedBigInteger('country_ate_id')->nullable()->index('fk_organization_country_ate1');
            $table->unsignedBigInteger('agency_id')->nullable()->index('fk_organization_agency1');

            $table->foreign(['category_id'], 'fk_organization_organization_category1')->references(['id'])->on('organization_category')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['address_id'], 'fk_organization_address1')->references(['id'])->on('address')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['country_id'], 'fk_organization_country1')->references(['id'])->on('country')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['known_as_organization_id'], 'fk_organization_organization1')->references(['id'])->on('organization')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['agency_id'], 'fk_organization_agency1')->references(['id'])->on('agency')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['country_ate_id'], 'fk_organization_country_ate1')->references(['id'])->on('country_ate')->onUpdate('NO ACTION')->onDelete('NO ACTION');

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
        Schema::dropIfExists('organization');
    }
};
