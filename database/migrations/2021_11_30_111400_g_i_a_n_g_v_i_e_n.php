<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GIANGVIEN extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giangvien', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ID_KHOA')->unsigned();
            $table->string('MAGV',150);
            $table->string('TEN',100);
            $table->tinyInteger('PHAI');
            $table->string('NGAYSINH');
            $table->string('SODIENTHOAI',50);
            $table->string('EMAIL',128);
            $table->string('DIACHI',128);
            $table->string('TENDANGNHAP',100);
            $table->string('MATKHAU',50);
            $table->tinyInteger('NGHIVIEC');
            $table->tinyInteger('THINHGIANG');
            $table->tinyInteger('THEME');
            $table->string('SRINGQUYEN',100);
            $table->string('HINHHOSO',100);
            $table->text('VANBANG');
            $table->timestamps();
            $table->foreign('ID_KHOA')->references('id')->on('khoa')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
