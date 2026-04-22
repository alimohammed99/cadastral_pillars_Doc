<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlanDocumentAndMultiCoordsToPillarInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up(): void
    {
        Schema::table('pillar_information', function (Blueprint $table) {

            $table->string('plan_document')->nullable()->after('plan_number');
            $table->text('name')->after('plan_document');
        });
    }

    public function down(): void
    {
        Schema::table('pillar_information', function (Blueprint $table) {
            $table->dropColumn('plan_document');

        });
    }
}
