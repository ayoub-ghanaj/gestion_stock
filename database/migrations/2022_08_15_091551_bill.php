<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('operation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wearhouse_id');
            $table->foreign('wearhouse_id')->references('id')->on('wearhouse')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title');
            $table->string('description');
            $table->string('company_name');
            $table->string('type');
            $table->float('bill_price');
            $table->integer('operation_status')->default(1);;
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
        //
    }
}
