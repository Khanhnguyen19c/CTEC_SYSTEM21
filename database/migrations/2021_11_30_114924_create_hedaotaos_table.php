<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHedaotaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hedaotaos', function (Blueprint $table) {
            $table->bigIncrements('ID_HEDAOTAO');
            $table->string('MAHEDAOTAO')->unique();
            $table->string('TENVIETTAT',10);
            $table->string('TENDAYDU',100);
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
        Schema::dropIfExists('hedaotaos');
    }
}
