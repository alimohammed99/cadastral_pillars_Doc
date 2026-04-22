<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePillarInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pillar_information', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('plan_number');
            $table->string('name');
            $table->string('location');
            $table->string('size_or_area');
            $table->string('pillar_number');
            $table->text('eastings');
            $table->text('northings');
            $table->string('origin');
            $table->decimal('height', 10, 2);
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('pillar_information');
    }
}