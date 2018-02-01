<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_entities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('lead_id')->unsigned();
            $table->integer('branch_id')->unsigned();
            $table->integer('office_entity_type_id')->unsigned();
            $table->string('description');
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
        Schema::dropIfExists('office_entities');
    }
}
