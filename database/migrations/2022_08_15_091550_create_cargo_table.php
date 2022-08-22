<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('garage_id');
            $table->foreign('garage_id')->references('id')->on('garage')->onDelete('cascade');
            $table->string('cargo_name');
            $table->integer('cargo_count')->default(0);
            $table->float('cargo_price');
            $table->string('cargo_logo')->default('storage/cargos_logos/defaultcar.png');
            $table->string('cargo_status')->default('1');
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
        Schema::dropIfExists('cargo');
    }
}
