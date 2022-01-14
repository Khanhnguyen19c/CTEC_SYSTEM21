<?php

namespace App\Http\Livewire\Student;

use App\Models\Ketquahocphan;
use App\Models\Lopchuyennganh;
use App\Models\Lophocphan;
use App\Models\Sinhvien;
use App\Models\Sinhvienlophocphan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Excel;
class PersonalScoreboardComponent extends Component
{
    public function getStudent(){

        $student = Sinhvien::whereHas('user', function($q)
        {
            $q->where('MASV',Auth::user()->code)->WhereNull('deleted_at');

        })->first();
        return  $student;
    }
    public function xeploai($points_HK){
        if (round($points_HK->tichluythang4, 2) >= 3.6) {
            return 'Xuất Sắc';
        } elseif (round($points_HK->tichluythang4, 2) >= 3.2) {
            return 'Giỏi';
        } elseif (round($points_HK->tichluythang4, 2) >= 2.5) {
            return 'Khá';
        } elseif (round($points_HK->tichluythang4, 2) >= 2.0) {
            return 'Trung Bình';
        } else {
            return  'Yếu';
        }
    }

    public function getDTB(){
        return DB::table('sinhvienlophocphan')
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
            ->whereIn('hocphans.LOAIHOCPHAN', ['Bắt Buộc', 'Tự Chọn']);
    }

    public function getPoint($hocky, $nienkhoa){
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


        $nienkhoa = Lopchuyennganh::where('ID_LOPCHUYENNGANH',$this->getStudent()->ID_LOPCHUYENNGANH)->FIRST();
        $khoa = $nienkhoa->NAMNHAPHOC;
        $sv = Carbon::now()->format('Y') - $khoa;


        if(Carbon::now()->format('m') == 9 or Carbon::now()->format('m') == 10 or Carbon::now()->format('m') == 11 or Carbon::now()->format('m') == 12 or Carbon::now()->format('m') == 1){
            $hocky = 1;
        }elseif(Carbon::now()->format('m') == 2 or Carbon::now()->format('m') == 3 or Carbon::now()->format('m') == 4 or Carbon::now()->format('m') == 5 or Carbon::now()->format('m') == 6){
            $hocky = 2;
        }else{
            $hocky = 3;
        }
        // lấy niên khoá

        $year = (Carbon::now()->format('Y') - 1).'-'.Carbon::now()->format('Y');


         //điểm số học kỳ hiện tại
        $scoreboard =$this->getPoint($hocky,$year);

        $points_HK = $this->getDTB()
        ->where('lophocphans.hocky',$hocky)
        ->where('lophocphans.nienkhoa',$year)
        ->first();

        //tích luỹ tniên khoá
        $TC_NK = $this->getDTB()
        ->where('lophocphans.nienkhoa',$year)
        ->first();

        $points_NK = $this->getDTB()
        ->where('lophocphans.nienkhoa',$year)
        ->first();

            //xếp loại niên khoa
            if($points_HK){
                $xeploai_hk = $this->xeploai($points_HK);
            }else{
                $xeploai_hk = "yếu";
            }
            if($points_NK){
                $xeploai_nk = $this->xeploai($points_NK);
            }else{
                $xeploai_nk = "yếu";
            }
        //tích luỹ tốt nghiệp
            $points_TN = $this->getDTB()->first();
            $TC_TN = $this->getDTB()->first();
            if($points_NK){
                $xeploai = $this->xeploai($points_TN);
            }else{
                $xeploai = "yếu";
            }
        return view('livewire.student.personal-scoreboard-component',[
            'xeploai_nk'=>$xeploai_nk,
            'points_NK'=>$points_NK,
            'xeploai_hk'=>$xeploai_hk,
            'points_HK'=>$points_HK,
            'xeploai'=>$xeploai,
            'sv'=>$sv,
            'scoreboard'=>$scoreboard,
            'points_TN'=>$points_TN,

            'TC_TN' => $TC_TN,
            'hocky' => $hocky,
            'nienkhoa' => $year,

            ]
            )->layout('layouts.layout',
            ['title' => 'Bảng điểm '.Auth()->user()->name .'-'.Auth()->user()->sinhvien->lopchuyennganh->MALOPCHUYENNGANH]);
    }
}
