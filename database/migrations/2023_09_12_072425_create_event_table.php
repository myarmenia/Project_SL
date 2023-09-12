


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
        Schema::create('event', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bibliography_id')->nullable()->index('fk_event_bibliography1_idx');
            $table->dateTime('date')->nullable();
            $table->unsignedBigInteger('address_id')->nullable()->index('fk_event_address1_idx');
            $table->unsignedBigInteger('organization_id')->nullable()->index('fk_event_organization1_idx');
            $table->unsignedBigInteger('aftermath_id')->nullable()->index('fk_event_aftermath1_idx');
            $table->unsignedBigInteger('opened_criminal_case_id')->nullable()->index('fk_event_criminal_case1_idx');
            $table->unsignedBigInteger('resource_id')->nullable()->index('fk_event_resource1');
            $table->unsignedBigInteger('agency_id')->nullable()->index('fk_event_agency1');
            $table->string('result')->nullable();

            $table->foreign(['opened_criminal_case_id'], 'fk_event_criminal_case1')->references(['id'])->on('criminal_case')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['resource_id'], 'fk_event_resource1')->references(['id'])->on('resource')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['aftermath_id'], 'fk_event_aftermath1')->references(['id'])->on('aftermath')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['bibliography_id'], 'fk_event_bibliography1')->references(['id'])->on('bibliography')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['organization_id'], 'fk_event_organization1')->references(['id'])->on('organization')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['address_id'], 'fk_event_address1')->references(['id'])->on('address')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['agency_id'], 'fk_event_agency1')->references(['id'])->on('agency')->onUpdate('NO ACTION')->onDelete('NO ACTION');
       
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
        Schema::dropIfExists('event');
    }
};
