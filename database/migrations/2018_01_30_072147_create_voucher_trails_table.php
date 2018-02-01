<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherTrailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher_trails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('voucher_id')->unsigned();
            $table->integer('response_by_id')->unsigned();
            $table->string('response');
            $table->timestamps();
        });
        Schema::table('voucher_trails', function (Blueprint $table) {
            $table->foreign('voucher_id')
                ->references('id')
                ->on('vouchers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('response_by_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voucher_trails');
    }
}
