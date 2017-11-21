<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vouchers', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            /*$table->foreign('office_entity_type_id')
                ->references('id')
                ->on('office_entity_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');*/
            $table->foreign('office_entity_id')
                ->references('id')
                ->on('office_entities')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            /*$table->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->onUpdate('cascade')
                ->onDelete('cascade');*/
        });

        Schema::table('items', function (Blueprint $table) {
            $table->foreign('voucher_id')
                ->references('id')
                ->on('vouchers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('office_entities', function (Blueprint $table) {
            $table->foreign('lead_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('branch_id')
                ->references('id')
                ->on('branches')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('office_entity_type_id')
                ->references('id')
                ->on('office_entity_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('users', function (Blueprint $table) {
            /*$table->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->onUpdate('cascade')
                ->onDelete('cascade');*/
            $table->foreign('office_entity_id')
                ->references('id')
                ->on('office_entities')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        /*Schema::table('departments', function (Blueprint $table) {
            $table->foreign('office_entity_type_id')
                ->references('id')
                ->on('office_entity_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
