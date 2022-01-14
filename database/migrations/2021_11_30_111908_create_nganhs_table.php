<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNganhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nganhs', function (Blueprint $table) {
            $table->id();
            $table->integer('ID_KHOA')->unsigned();
            $table->string('MANGANH',64);
            $table->string('TENNGANH');
            $table->tinyInteger('ID_BACDAOTAO');
            $table->tinyInteger('ID_HEDAOTAO');
            $table->string('GHICHU',128);
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
        Schema::dropIfExists('nganhs');
    }
}
