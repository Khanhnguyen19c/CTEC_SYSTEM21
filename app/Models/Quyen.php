<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quyen extends Model
{
    use HasFactory;
    protected $table = 'quyen';
    protected $fillable = ['MA_QUYEN','DIENGIAI','ID_GIAOVIENQUANLY','GHICHU'];
    protected $primaryKey ='ID_QUYEN';

    public function quyengv(){
        return $this->hasMany(quyengv::class,'ID_QUYEN','ID_QUYEN');
    }
    public function giangvien(){
        return $this->belongsTo(giangvien::class,'ID_GIAOVIENQUANLY','ID_GIANGVIEN');
    }
}
