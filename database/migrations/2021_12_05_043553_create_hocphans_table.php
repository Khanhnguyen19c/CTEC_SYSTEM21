<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHocphansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hocphans', function (Blueprint $table) {
            $table->bigIncrements('ID_HOCPHAN');
            $table->bigInteger('ID_KHOA',false,true)->unsigned()->length(20);
            $table->string('MAHOCPHAN',128);
            $table->string('TENHOCPHAN',255);
            $table->tinyInteger('SOCHI',false,true)->length(5);
            $table->tinyInteger('LYTHUYET',false,true)->length(5);
            $table->tinyInteger('THUCHANH',false,true)->length(5);
            $table->string('LOAIHOCPHAN',20);
            $table->bigInteger('ID_BACDAOTAO',false,true)->unsigned()->length(20);
            $table->bigInteger('ID_HEDAOTAO',false,true)->unsigned()->length(20);
            $table->bigInteger('ID_QUYCHEDAOTAO',false,true)->length(20);
            $table->tinyInteger('TINHTRANG',false,true)->length(1);
            $table->string('GHICHU',255)->nullable();
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
        Schema::dropIfExists('hocphans');
    }
}
