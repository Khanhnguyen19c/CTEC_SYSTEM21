<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nganh extends Model
{
    use HasFactory;
    protected $table= "nganhs";
    protected $primaryKey = 'ID_NGANH';

    public function bacdaotao(){
        return $this->belongsTo(Bacdaotao::class,'ID_BACDAOTAO','ID_BACDAOTAO');
    }
    public function hedaotao(){
        return $this->belongsTo(Hedaotao::class,'ID_HEDAOTAO','ID_HEDAOTAO');
    }
     public function khoa(){
         return $this->belongsTo(Khoa::class,'ID_KHOA','ID_KHOA');
     }
     
}
