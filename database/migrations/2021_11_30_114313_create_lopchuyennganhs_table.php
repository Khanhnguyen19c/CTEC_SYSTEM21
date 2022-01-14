<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLopchuyennganhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lopchuyennganhs', function (Blueprint $table) {
            $table->bigIncrements('ID_LOPCHUYENNGANH');
            $table->bigInteger('ID_CHUYENNGANH')->unsigned();
            $table->string('MALOPCHUYENNGANH');
            $table->year('NAMNHAPHOC',4);
            $table->integer('SISO');
            $table->integer('GVCN');
            $table->integer('CS');
            $table->string('GHICHU',256);
            $table->integer('ID_BACDAOTAO');
            $table->integer('ID_HEDAOTAO');
            $table->integer('ID_QUYCHEDAOTAO');
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
        Schema::dropIfExists('lopchuyennganhs');
    }
}
