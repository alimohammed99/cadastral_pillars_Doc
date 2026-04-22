<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifySurveyColumnInPillarInformationDrop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Check if the 'survey' column exists before attempting to drop it
        if (Schema::hasColumn('pillar_information', 'survey')) {
            Schema::table('pillar_information', function (Blueprint $table) {
                $table->dropColumn('survey');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Optionally, add back the 'survey' column if needed in a rollback
        Schema::table('pillar_information', function (Blueprint $table) {
            $table->string('survey');
        });
    }
}