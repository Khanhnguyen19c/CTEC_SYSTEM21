<?php

namespace App\Http\Livewire;

use App\Models\Lopchuyennganh;
use App\Models\Sinhvien;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EducationProgramComponent extends Component
{
    //get student
    public function getStudent(){
        $student = Sinhvien::whereHas('user', function($q)
        {
            $q->where('MASV',Auth::user()->code)->WhereNull('deleted_at');

        })->first();
        return $student;
    }
      //bảng điểm
    public function getPoint($hocky,$nienkhoa){
        return DB::table('sinhvienlophocphan')
        ->leftJoin('ketquahocphan', function ($join) {
            $join->on('sinhvienlophocphan.ID_LOPHOCPHAN', '=', 'ketquahocphan.ID_LOPHOCPHAN');
            $join->on('sinhvienlophocphan.ID_SINHVIEN','=','ketquahocphan.ID_SINHVIEN');
        })
            ->join('lophocphans', 'lophocphans.ID_LOPHOCPHAN', '=', 'sinhvienlophocphan.ID_LOPHOCPHAN')
            ->join('hocphans', 'hocphans.ID_HOCPHAN', '=', 'lophocphans.ID_HOCPHAN')
            ->join('giangvien', 'giangvien.ID_GIANGVIEN', '=', 'lophocphans.ID_GIAOVIEN')
            ->WhereNULL('lophocphans.deleted_at')
            ->WhereNULL('ketquahocphan.deleted_at')
            ->Where('lophocphans.HOCKY', $hocky)
            ->Where('lophocphans.NIENKHOA', $nienkhoa)
            ->Where('sinhvienlophocphan.ID_SINHVIEN', $this->getStudent()->ID_SINHVIEN)
            ->get();
    }

    public function render()
    {

        //lấy niên khoá các năm học
        $nienkhoa = Lopchuyennganh::where('ID_LOPCHUYENNGANH',$this->getStudent()->ID_LOPCHUYENNGANH)->FIRST();
        $khoa = $nienkhoa->NAMNHAPHOC;
        $nienkhoa1 = $khoa."-".($khoa+1);
        $nienkhoa2 = ($khoa+1)."-".($khoa+2);
        $nienkhoa3 = ($khoa+2)."-".($khoa+3);

         //tích luỹ tốt nghiệp
         $points_TN = DB::table('sinhvienlophocphan')
         ->select(DB::raw("SUM(hocphans.SOCHI) as TINCHI,sum(ketquahocphan.TRUNGBINH10 * hocphans.SOCHI)/SUM(hocphans.SOCHI) as tichluythang10,
             sum(ketquahocphan.TRUNGBINH4 * hocphans.SOCHI)/SUM(hocphans.SOCHI) as tichluythang4"))

         ->leftJoin('ketquahocphan', function ($join) {
             $join->on('sinhvienlophocphan.ID_LOPHOCPHAN', '=', 'ketquahocphan.ID_LOPHOCPHAN');
             $join->on('sinhvienlophocphan.ID_SINHVIEN','=','ketquahocphan.ID_SINHVIEN');
         })
             ->join('lophocphans', 'lophocphans.ID_LOPHOCPHAN', '=', 'sinhvienlophocphan.ID_LOPHOCPHAN')
             ->join('hocphans', 'hocphans.ID_HOCPHAN', '=', 'lophocphans.ID_HOCPHAN')
             ->Where('sinhvienlophocphan.ID_SINHVIEN', $this->getStudent()->ID_SINHVIEN)
             ->WhereNULL('lophocphans.deleted_at')
             ->WhereNULL('ketquahocphan.deleted_at')
             ->WhereNULL('hocphans.deleted_at')
             ->whereIn('hocphans.LOAIHOCPHAN', ['Bắt Buộc', 'Tự Chọn'])
            ->first();
        //điểm học kỳ 1 năm nhất
        $points_HK1_NK1 = $this->getPoint(1,$nienkhoa1);


        $points_HK2_NK1 = $this->getPoint(2,$nienkhoa1);


        $points_HK1_NK2 = $this->getPoint(1,$nienkhoa2);


        $points_HK2_NK2 = $this->getPoint(2,$nienkhoa2);


        $points_HK1_NK3 = $this->getPoint(1,$nienkhoa3);


        return view('livewire.education-program-component',[

            'points_HK1_NK1'=>$points_HK1_NK1,
            'points_HK2_NK1'=>$points_HK2_NK1,
            'points_HK1_NK2'=>$points_HK1_NK2,
            'points_HK2_NK2'=>$points_HK2_NK2,
            'points_HK1_NK3'=>$points_HK1_NK3,

            'points_TN'=>$points_TN,
            'nienkhoa1'=>$nienkhoa1,
            'nienkhoa2'=>$nienkhoa2,
            'nienkhoa3'=>$nienkhoa3,
        ])->layout('layouts.layout',
        ['title' => 'Kết quả tích luỹ ' . Auth()->user()->name . ' - ' . Auth()->user()->sinhvien->lopchuyennganh->MALOPCHUYENNGANH]
    );
    }
}
