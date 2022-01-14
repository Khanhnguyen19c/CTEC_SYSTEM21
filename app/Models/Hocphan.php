<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hocphan extends Model
{
    use HasFactory;
    protected $table = 'hocphans';
    protected $primaryKey ='ID_HOCPHAN';

    public function khoa(){
        return $this->belongsTo(Khoa::class,'ID_KHOA','ID_KHOA');
    }
    public function hedaotao(){
        return $this->belongsTo(Hedaotao::class,'ID_HEDAOTAO','ID_HEDAOTAO');
    }
    public function bacdaotao(){
        return $this->belongsTo(Bacdaotao::class,'ID_BACDAOTAO','ID_BACDAOTAO');
    }
    public function lophocphan(){
        return $this->hasMany(Lophocphan::class,'ID_HOCPHAN','ID_HOCPHAN');
    }
}
