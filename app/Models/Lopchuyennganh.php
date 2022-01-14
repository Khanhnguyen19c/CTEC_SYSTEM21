<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lopchuyennganh extends Model
{
    use HasFactory;
    protected $table= 'lopchuyennganhs';
    protected $primaryKey = 'ID_LOPCHUYENNGANH';

    public function chuyennganh(){
        return $this->belongsTo(Chuyennganh::class,'ID_CHUYENNGANH','ID_CHUYENNGANH');
    }
    public function bacdaotao(){
        return $this->belongsTo(Bacdaotao::class,'ID_BACDAOTAO','ID_BACDAOTAO');
    }
    public function hedaotao(){
        return $this->belongsTo(Hedaotao::class,'ID_HEDAOTAO','ID_HEDAOTAO');
    }
    public function giangvien(){
        return $this->belongsTo(Giangvien::class,'GVCN','ID_GIANGVIEN');

    }
    
}
