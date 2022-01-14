<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sinhvien extends Model
{
    use HasFactory;
    protected $table = 'sinhviens';

    protected $fillable=['ID_KHOA','ID_NGANH','ID_CHUYENNGANH','ID_LOPCHUYENNGANH','ID_BACDAOTAO','ID_HEDAOTAO','MASV','HODEM','TEN','NGAYSINH','PHAI','HOKHAU','DIACHILIENLAC','SOHOSO','GHICHU',
    'NGAYVAOTRUONG',
    'NAMNHAPHOC',
    'DATOTNGHIEP',
    'CANHBAOHV',
    'CMND',
    'NGAYCAP',
    'NOICAP',
    'NOISINH',
    'EMAIL',
    'SODIENTHOAI',
    'SODIENTHOAI2',
    'DANTOC',
    'TONGIAO',
    'DIENCHINHSACH',
    'DOITUONGUUTIEN',
    'TPGIADINH',
    'TRINHDOVANHOA',
    'NGAYKETNAPDOAN',
    'NOIKETNAPDOAN',
    'NGAYKETNAPDANG',
    'NOIKETNAPDANG',
    'QUATRINHCONGTAC',
    'DIACHILIENLAC',
    'HOTENVOCHONG',
    'NGHENGHIEPVOCHONG',
    'HINHANH',
    'HOTENCHA',
    'NAMSINHCHA',
    'DANTOCCHA',
    'TONGIAOCHA',
    'NGHECHA',
    'SODIENTHOAICHA',
    'HOTENME',
    'NAMSINHME',
    'DANTOCME',
    'TONGIAOME',
    'NGHEME',
    'SODIENTHOAIME',
    'DIACHICHAME',
    'BAOLUU',
    'SOHOSO',
    'DATOTNGHIEP',
    'HINHHOSO',
    'HINHDAIDIEN',
    'CCATINHOC',
    'CCAANHVAN',
    'SOTKNGANHANG',
];
    protected $primaryKey = 'ID_SINHVIEN';

    public function khoa(){
        return $this->belongsTo(Khoa::class,"ID_KHOA","ID_KHOA");
    }
    public function nganh(){
        return $this->belongsTo(Nganh::class,"ID_NGANH","ID_NGANH");
    }
    public function chuyennganh(){
        return $this->belongsTo(Chuyennganh::class,"ID_CHUYENNGANH","ID_CHUYENNGANH");
    }
    public function lopchuyennganh(){
        return $this->belongsTo(Lopchuyennganh::class,"ID_LOPCHUYENNGANH","ID_LOPCHUYENNGANH");
    }
    public function bacdaotao(){
        return $this->belongsTo(Bacdaotao::class,"ID_BACDAOTAO","ID_BACDAOTAO");
    }
    public function hedaotao(){
        return $this->belongsTo(Hedaotao::class,"ID_HEDAOTAO","ID_HEDAOTAO");
    }
    public function user(){
        return $this->hasOne(User::class,"code","MASV");
    }
}
