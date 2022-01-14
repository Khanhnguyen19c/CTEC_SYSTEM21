<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBacdaotaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bacdaotaos', function (Blueprint $table) {
            $table->bigIncrements('ID_BACDAOTAO');
            $table->string('MABACDAOTAO')->unique();
            $table->string('TENVIETTAT',10);
            $table->string('TENDAYDU',100);
            $table->string('TENGOIHV',50);
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
        Schema::dropIfExists('bacdaotaos');
    }
}
