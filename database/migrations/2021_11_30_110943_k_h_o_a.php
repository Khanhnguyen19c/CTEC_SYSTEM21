<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KHOA extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('KHOA', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('MAKHOA',100);
            $table->string('TENKHOA',150);
            $table->string('TENVIETTAT',20);
            $table->integer('TRUONGKHOA');
            $table->string('GHICHU');
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
        Schema::dropIfExists('KHOA');
    }
}
