<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khoa extends Model
{
    use HasFactory;
    protected $table = 'khoa';
    protected $primaryKey ='ID_KHOA';
    public function giangvien(){
        return $this->hasMany(Giangvien::class,'ID_KHOA','ID_KHOA');
    }
}
