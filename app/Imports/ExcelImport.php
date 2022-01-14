<?php

namespace App\Imports;

use App\Models\Sinhvien;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use App\Model\Admin\ParentsDetaills;
use App\Models\Bacdaotao;
use App\Models\Chuyennganh;
use App\Models\Hedaotao;
use App\Models\Khoa;
use App\Models\Lopchuyennganh;
use App\Models\Nganh;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;


class ExcelImport implements ToCollection,WithHeadingRow
{

    /**
    * @param Collection $collection
    */
    public function headingRow(): int
    {
        return 13;
    }
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $MAKHOA = Khoa::where('MAKHOA',$row['ma_khoa'])->whereNull('deleted_at')->first();
            $NGANH = Nganh::where('MANGANH',$row['ma_nganh'])->whereNull('deleted_at')->first();
            $CHUYENNGANH = Chuyennganh::where('MACHUYENNGANH',$row['ma_chuyennganh'])->whereNull('deleted_at')->first();
            $LOPCHUYENNGANH = Lopchuyennganh::where('MALOPCHUYENNGANH',$row['ma_lopchuyennganh'])->whereNull('deleted_at')->first();
            $BACDAOTAO = Bacdaotao::where('MABACDAOTAO',$row['ma_bacdaotao'])->whereNULL('deleted_at')->first();
            $HEDAOTAO = Hedaotao::where('MAHEDAOTAO',$row['ma_hedaotao'])->whereNULL('deleted_at')->first();

            Sinhvien::create([
            'SOHOSO' => $row['sohoso'],
            'ID_KHOA' => $MAKHOA->ID_KHOA,
            'ID_NGANH' =>  $NGANH->ID_NGANH,
            'ID_CHUYENNGANH'=> $CHUYENNGANH->ID_CHUYENNGANH,
            'ID_LOPCHUYENNGANH' => $LOPCHUYENNGANH->ID_LOPCHUYENNGANH,
            'ID_BACDAOTAO'=> $BACDAOTAO->ID_BACDAOTAO,
            'ID_HEDAOTAO' =>  $HEDAOTAO->ID_HEDAOTAO,
            'MASV' => $row['masv'],
            'HODEM' => $row['hodem'],
            'TEN' => $row['ten'],
            'NGAYSINH' => $row['ngaysinh'],
            'PHAI' => $row['gioitinh'],
            'HOKHAU' => $row['hokhau'],
            'DIACHILIENLAC' => $row['hokhau'],
            'GHICHU' => $row['ghichu'],
            'NGAYVAOTRUONG' => $row['ngayvaotruong'],
            'NAMNHAPHOC' => $row['namvaotruong'],
            'DATOTNGHIEP' => $row['datotnghiep'],
            'CANHBAOHV' => $row['canhbaohv'],
            'CMND' => $row['cmnd'],
            'NGAYCAP' => $row['ngaycap'],
            'NOICAP' => $row['noicap'],
            'NOISINH' => $row['noisinh'],
            'EMAIL' => $row['email'],
            'SODIENTHOAI' => $row['sodienthoai'],
            'SODIENTHOAI2' => $row['sodienthoai2'],
            'DANTOC' => $row['dantoc'],
            'TONGIAO' => $row['tongiao'],
            'DIENCHINHSACH' => $row['dienchinhsach'],
            'DOITUONGUUTIEN' => $row['doituonguutien'],
            'TPGIADINH' => $row['tpgiadinh'],
            'TRINHDOVANHOA' => $row['trinhdovanhoa'],
            'NGAYKETNAPDOAN' => $row['ngayketnapdoan'],
            'NOIKETNAPDOAN' => $row['noiketnapdoan'],
            'NGAYKETNAPDANG' => $row['ngayketnapdang'],
            'NOIKETNAPDANG' => $row['noiketnapdang'],
            'QUATRINHCONGTAC' => $row['quatrinhcongtac'],
            'DIACHILIENLAC' => $row['diachilienlac'],
            'HOTENVOCHONG' => $row['hotenvochong'],
            'NGHENGHIEPVOCHONG' => $row['nghenghiepvochong'],
            'HINHANH' => $row['hinhanh'],
            'HOTENCHA' => $row['hotencha'],
            'NAMSINHCHA' => $row['namsinhcha'],
            'DANTOCCHA' => $row['dantoccha'],
            'TONGIAOCHA' => $row['tongiaocha'],
            'NGHECHA' => $row['nghecha'],
            'SODIENTHOAICHA' => $row['sodienthoaicha'],
            'HOTENME' => $row['hotenme'],
            'NAMSINHME' => $row['namsinhme'],
            'DANTOCME' => $row['dantocme'],
            'TONGIAOME' => $row['tongiaome'],
            'NGHEME' => $row['ngheme'],
            'SODIENTHOAIME' => $row['sodienthoaime'],
            'DIACHICHAME' => $row['diachichame'],
            'BAOLUU' => $row['baoluu'],
            'SOHOSO' => $row['sohoso'],
            'DATOTNGHIEP' => $row['datotnghiep'],
            'HINHHOSO' => $row['hinhhoso'],
            'HINHDAIDIEN' => $row['hinhdaidien'],
            'CCATINHOC' => $row['ccatinhoc'],
            'CCAANHVAN' => $row['ccaanhvan'],
            'SOTKNGANHANG' => $row['sotaikhoan'],
            ]);
        $user =  User::create([
           'code' => $row['masv'],
           'name' => $row['hodem'] .' '.$row['ten'],
           'email' => $row['email'],
           'utype' => 'Student',
           'password' => Hash::make($row['masv'].substr($row['cmnd'],-4)),
        ]);
        }

    }

}
