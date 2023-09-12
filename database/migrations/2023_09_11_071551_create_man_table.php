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
        Schema::create('man', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gender_id')->nullable()->index('fk_man_sex1_idx');
            $table->unsignedBigInteger('nation_id')->nullable()->index('fk_man_nation1_idx');
            $table->unsignedBigInteger('born_address_id')->nullable()->index('fk_man_address1_idx');
            $table->unsignedBigInteger('knowen_man_id')->nullable()->index('fk_man_man1_idx');
            $table->date('birthday')->nullable();
            $table->string('start_year')->nullable();
            $table->integer('end_year')->nullable();
            $table->text('attention')->nullable();
            $table->unsignedBigInteger('religion_id')->nullable()->index('fk_man_religion1_idx');
            $table->text('occupation')->nullable();
            $table->text('opened_dou')->nullable();
            $table->date('start_wanted')->nullable();
            $table->date('entry_date')->nullable();
            $table->date('exit_date')->nullable();
            $table->date('fixing_moment')->nullable();
            $table->unsignedBigInteger('resource_id')->nullable()->index('fk_man_resource1');

            $table->foreign(['born_address_id'], 'fk_man_address1')->references(['id'])->on('address')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['nation_id'], 'fk_man_nation1')->references(['id'])->on('nation')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['resource_id'], 'fk_man_resource1')->references(['id'])->on('resource')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['knowen_man_id'], 'fk_man_man1')->references(['id'])->on('man')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['religion_id'], 'fk_man_religion1')->references(['id'])->on('religion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['gender_id'], 'fk_man_sex1')->references(['id'])->on('gender')->onUpdate('NO ACTION')->onDelete('NO ACTION');

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
        Schema::dropIfExists('man');
    }
};
