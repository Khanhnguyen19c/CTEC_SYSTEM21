<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ketquahocphan extends Model
{
    use HasFactory;
    protected $table = 'ketquahocphan';
    protected $fillable = ['ID_HOCPHAN','ID_LOPHOCPHAN','ID_SINHVIEN',
    'HS11','HS12','HS13','HS21','HS22','HS23','TBM','THILAN1','THILAN2','TRUNGBINH10',
    'TRUNGBINH4','SOTIETVANGLYTHUYET','SOTIETVANGTHUCHANH','DAT','GHICHU'];
    protected $primaryKey = 'ID_KETQUAHOCPHAN';

    public function lophocphan(){
        return $this->belongsTo(Lophocphan::class,'ID_LOPHOCPHAN','ID_LOPHOCPHAN');
    }
    public function hocphan(){
        return $this->belongsTo(Hocphan::class,'ID_HOCPHAN','ID_HOCPHAN');
    }
    public function sinhvien(){
        return $this->belongsTo(Sinhvien::class,'ID_SINHVIEN','ID_SINHVIEN');
    }
}
