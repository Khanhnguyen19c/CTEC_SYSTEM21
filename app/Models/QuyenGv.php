<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuyenGv extends Model
{
    use HasFactory;
    protected $table = 'quyengiangvien';
    protected $primaryKey ='ID_GVQUYEN';

    public function quyen(){
        return $this->hasMany(quyen::class,'ID_QUYEN','ID_QUYEN');
    }
    public function giangvien(){
        return $this->belongsTo(giangvien::class,'ID_GIAOVIEN','ID_GIANGVIEN');
    }
}
