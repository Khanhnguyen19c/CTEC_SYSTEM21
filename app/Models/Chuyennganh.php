<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chuyennganh extends Model
{
    use HasFactory;
    protected $table= 'chuyennganhs';
    protected $primaryKey = 'ID_CHUYENNGANH';
    public function hedaotao(){
        return $this->belongsTo(Hedaotao::class,'ID_HEDAOTAO','ID_HEDAOTAO');
    }
    public function bacdaotao(){
        return $this->belongsTo(Bacdaotao::class,'ID_BACDAOTAO','ID_BACDAOTAO');
    }
    public function lopchuyennganh(){
        return $this->hasMany(Lopchuyennganh::class,'ID_CHUYENNGANH','ID_CHUYENNGANH');
    }
    public function nganh(){
        return $this->belongsTo(nganh::class,'ID_NGANH','ID_NGANH');
    }
}
