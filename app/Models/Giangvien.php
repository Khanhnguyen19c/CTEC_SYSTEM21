<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giangvien extends Model
{
    use HasFactory;
    protected $table = 'giangvien';
    protected $primaryKey = 'ID_GIANGVIEN';
    public function khoa (){
        return $this->belongsTo(Khoa::class,'ID_KHOA','ID_KHOA');
    }
    public function lopchuyennganh(){
        return $this->hasMany(Lopchuyennganh::class,'ID_GIANGVIEN','GVHD');
    }
    public function user(){
        return $this->belongsTo(User::class,'TENDANGNHAP','code');
    }
    public function roles(){
        return $this->belongsToMany(Quyen::class,'quyengiangvien','ID_GIAOVIEN','ID_QUYEN');
    }
    public function roles_gv(){
        return $this->hasMany(QuyenGv::class,'ID_GIAOVIEN','ID_GIANGVIEN');
    }

}
