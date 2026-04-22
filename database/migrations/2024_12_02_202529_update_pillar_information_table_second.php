<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePillarInformationTableSecond extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pillar_information', function (Blueprint $table) {
            // Remove the old columns
            $table->dropColumn('name');
            $table->dropColumn('size_or_area');

            // Add the new columns
            $table->string('survey')->after('location');
            $table->string('unit')->after('survey');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pillar_information', function (Blueprint $table) {
            // Re-add the removed columns
            $table->string('name')->after('plan_number');
            $table->string('size_or_area')->after('location');

            // Remove the new columns
            $table->dropColumn('survey');
            $table->dropColumn('unit');
        });
    }
}