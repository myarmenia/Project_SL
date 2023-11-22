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
        Schema::table('man', function (Blueprint $table) {
            $table->string('full_name')->nullable()->after('id');
            $table->index('full_name', 'man_full_name_index')->length(191);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('man', function (Blueprint $table) {
            $table->dropColumn('full_name');
        });
    }
};
