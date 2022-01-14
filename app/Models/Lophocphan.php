<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lophocphan extends Model
{
    use HasFactory;
    protected $table= 'lophocphans';
    protected $primaryKey = 'ID_LOPHOCPHAN';

    public function hocphan(){
        return $this->belongsTo(Hocphan::class,'ID_HOCPHAN','ID_HOCPHAN');
    }
    public function hedaotao(){
        return $this->belongsTo(Hedaotao::class,'ID_HEDAOTAO','ID_HEDAOTAO');
    }
    public function bacdaotao(){
        return $this->belongsTo(Bacdaotao::class,'ID_BACDAOTAO','ID_BACDAOTAO');
    }
    public function khoa(){
        return $this->belongsTo(Khoa::class,'ID_KHOA','ID_KHOA');
    }
    public function sinhvienlophocphan(){
        return $this->hasMany(Sinhvienlophocphan::class,'ID_LOPHOCPHAN','ID_LOPHOCPHAN');
    }
    public function giaovien(){
        return $this->belongsTo(Giangvien::class,'ID_GIAOVIEN','ID_GIANGVIEN');
    }
    public function ketquahocphan(){
        return $this->belongsTo(Ketquahocphan::class,'ID_LOPHOCPHAN','ID_LOPHOCPHAN');
    }
}
