<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sinhvienlophocphan extends Model
{
    use HasFactory;
    protected $table = 'sinhvienlophocphan';
    protected $primaryKey = 'ID';

    public function lophocphan(){
        return $this->belongsTo(Lophocphan::class,'ID_LOPHOCPHAN','ID_LOPHOCPHAN');
    }
    public function lopchuyennganh(){
        return $this->belongsTo(Lopchuyennganh::class,'ID_LOPCHUYENNGANH','ID_LOPCHUYENNGANH');
    }
    public function sinhvien(){
        return $this->belongsTo(Sinhvien::class,'ID_SINHVIEN','ID_SINHVIEN');
    }
   
}
