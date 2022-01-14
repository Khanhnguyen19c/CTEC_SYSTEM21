<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Giangvien;

use App\Exports\ExcelExportScore;
use App\Exports\ExcelExportScoreCTDL;
use App\Exports\ExcelExportScoreHK;
use App\Models\Ketquahocphan;
use App\Models\Lopchuyennganh;
use App\Models\Lophocphan;
use App\Models\Sinhvien;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Excel;
class ListScoreOfTeacherComponent extends Component
{
    public $MASV;
    public $student;

    public function mount($ID_SINHVIEN)
    {
        $student = Sinhvien::where('ID_SINHVIEN',$ID_SINHVIEN)->WhereNull('deleted_at')->first();
        $this->student = $student;

    }
    public function getStudent()
    {
        $student = Sinhvien::where('ID_SINHVIEN', $this->student->ID_SINHVIEN)->WhereNull('deleted_at')->first();

        return $student;
    }
    public function export_DSHP(){

        return (new ExcelExportScore($this->student))->download('Bảng điểm'.$this->student->HODEM.' '.$this->student->TEN.' - '.$this->student->MASV.'.xlsx');
    }

    public function export_CTDT(){

        return (new ExcelExportScoreCTDL($this->student))->download('Bảng điểm'.$this->student->HODEM.' '.$this->student->TEN.' - '.$this->student->MASV.'.xlsx');
    }

    public function export_HK(){

        return (new ExcelExportScoreHK($this->student))->download('Bảng điểm'.$this->student->HODEM.' '.$this->student->TEN.' - '.$this->student->MASV.'.xlsx');
    }

    public function getXLTL($DTB)
    {
        if (round($DTB, 2) >= 3.6) {
            return 'Xuất Sắc';
        } elseif (round($DTB, 2) >= 3.2) {
            return 'Giỏi';
        } elseif (round($DTB, 2) >= 2.5) {
            return 'Khá';
        } elseif (round($DTB, 2) >= 2.0) {
            return 'Trung Bình';
        } else {
            return 'Yếu';
        }
    }
    /**
     * Trung bình môn
     *
     *
     */
    //trung bình môn
    public function getTBM()
    {
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
    /**
     * Bảng điểm
     *
     * @param [type] $hocky
     * @param [type] $nienkhoa
     *
     */
    public function getPoint($hocky, $nienkhoa)
    {
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


    /**
     * Xếp Loại Sinh viên
     *
     * @param [type] $points_HK
     *
     */
    public function xeploai($points_HK)
    {
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
    /**
     * Trung bình tích luỹ
     *
     *
     */
    public function getTBTL($hocky, $nienkhoa)
    {
        return  DB::table('sinhvienlophocphan')->select(DB::raw("SUM(ketquahocphan.TRUNGBINH10 * hocphans.SOCHI) as DTB, SUM(hocphans.SOCHI) as SOCHI,SUM(ketquahocphan.TRUNGBINH4 * hocphans.SOCHI) as tichluythang4"))
        ->join('ketquahocphan', function ($join) {
            $join->on('sinhvienlophocphan.ID_LOPHOCPHAN', '=', 'ketquahocphan.ID_LOPHOCPHAN');
            $join->on('sinhvienlophocphan.ID_SINHVIEN','=','ketquahocphan.ID_SINHVIEN');
        })
                ->join('lophocphans', 'lophocphans.ID_LOPHOCPHAN', '=', 'sinhvienlophocphan.ID_LOPHOCPHAN')
                ->join('hocphans', 'hocphans.ID_HOCPHAN', '=', 'lophocphans.ID_HOCPHAN')
                ->join('giangvien', 'giangvien.ID_GIANGVIEN', '=', 'lophocphans.ID_GIAOVIEN')

            ->Where('lophocphans.HOCKY', $hocky)
            ->Where('lophocphans.NIENKHOA', $nienkhoa)
            ->WhereNULL('ketquahocphan.deleted_at')
            ->WhereNULL('hocphans.deleted_at')
            ->whereIn('hocphans.LOAIHOCPHAN', ['Bắt Buộc', 'Tự Chọn'])
            ->Where('sinhvienlophocphan.ID_SINHVIEN', $this->getStudent()->ID_SINHVIEN)
            ->first();
    }
    /**
     * Undocumented function
     *
     *
     */
    public function getDTL($hocky, $nienkhoa)
    {
        $TBTL = 0;
        $khoahoc = Lopchuyennganh::where('ID_LOPCHUYENNGANH', $this->getStudent()->ID_LOPCHUYENNGANH)->FIRST();
        $khoa = $khoahoc->NAMNHAPHOC; //2019
        $namNienKhoa = substr($nienkhoa, 5, 4); //2020
        for ($i = $khoa; $i < $namNienKhoa; $i++) {

            $nk = $i . "-" . ($i + 1);
            if ($nk !== $nienkhoa) {
                $TBTL =  $TBTL + round($this->getTBTL(1, $nk)->DTB, 2);

                $TBTL =  $TBTL + round($this->getTBTL(2, $nk)->DTB, 2);
            } else {
                if ($hocky == 1) {
                    // DD($this->getTBTL(1,$nienkhoa));
                    $TBTL =  $TBTL + round($this->getTBTL(1, $nk)->DTB, 2);
                } elseif ($hocky == 2) {
                    $TBTL =  $TBTL + round($this->getTBTL(1, $nk)->DTB, 2);

                    $TBTL =  $TBTL + round($this->getTBTL(2, $nk)->DTB, 2);
                }
            }
        }

        return $TBTL;
    }

    public function getDTLT4($hocky, $nienkhoa)
    {
        $TBTL4 = 0;
        $khoahoc = Lopchuyennganh::where('ID_LOPCHUYENNGANH', $this->getStudent()->ID_LOPCHUYENNGANH)->FIRST();
        $khoa = $khoahoc->NAMNHAPHOC;
        $namNienKhoa = substr($nienkhoa, 5, 4);
        //NIEN KHOA 2020-2021
        for ($i = $khoa; $i < $namNienKhoa; $i++) {
            $nk = $i . "-" . ($i + 1);
            if ($nienkhoa !== $nk) {
                $TBTL4 =  $TBTL4 + ($this->getTBTL(1, $nk)->tichluythang4);

                $TBTL4 = ($TBTL4 + $this->getTBTL(2, $nk)->tichluythang4);
            } else {

                if ($hocky == 1) {
                    $TBTL4 =  ($TBTL4 + $this->getTBTL(1, $nk)->tichluythang4);
                } elseif ($hocky == 2) {
                    $TBTL4 =  $TBTL4 + ($this->getTBTL(1, $nk)->tichluythang4);

                    $TBTL4 =  ($TBTL4 + $this->getTBTL(2, $nk)->tichluythang4);
                }
            }
        }
        return $TBTL4;
    }
    public function render()
    {

        $title_scoreboard = DB::table('lophocphans')->leftjoin('ketquahocphan', 'lophocphans.ID_LOPHOCPHAN', '=', 'ketquahocphan.ID_LOPHOCPHAN')
            ->where('ID_SINHVIEN', $this->getStudent()->ID_SINHVIEN)
            ->whereNull('lophocphans.deleted_at')->first();
        // dd($title_scoreboard);

        //lấy niên khoá các năm học
        $nienkhoa = Lopchuyennganh::where('ID_LOPCHUYENNGANH', $this->getStudent()->ID_LOPCHUYENNGANH)->FIRST();
        $khoa = $nienkhoa->NAMNHAPHOC;
        $nienkhoa1 = $khoa . "-" . ($khoa + 1);
        $nienkhoa2 = ($khoa + 1) . "-" . ($khoa + 2);
        $nienkhoa3 = ($khoa + 2) . "-" . ($khoa + 3);

        $sv = Carbon::now()->format('Y') - $khoa;

        /**
         * Bảng điểm Học kỳ 1 niên khoá 1
         * $points_HK1_NK1 = Bảng điểm học 1 niên khoá 1
         * $TBM_HK1_NK1 = Trung bình môn học kỳ 1 niên khoá 1
         * $TBM_NK1 = Trung bình môn niên khoá 1
         * $TC_NK1 = Tín chỉ tích luỹ của niên khoá 1
         * $XL_HK1_NK1 = Xếp loại Học kỳ 1 niên khoá 1
         * $XL_NK1 = Xếp loại niên khoá 1
         */
        $points_HK1_NK1 = $this->getPoint(1, $nienkhoa1);

        // dd($points_HK1_NK1);
        $TBM_HK1_NK1 = $this->getTBM()
            ->where('lophocphans.hocky', 1)
            ->where('lophocphans.nienkhoa', $nienkhoa1)
            ->first();

        // dd($TBM_HK1_NK1);
        $XL_HK1_NK1 = $this->xeploai($TBM_HK1_NK1);


        /**
         * Bảng điểm Học kỳ 2 niên khoá 1
         * $points_HK2_NK1 = Bảng điểm học 2 niên khoá 1
         * $TBM_HK2_NK1 = Trung bình môn học kỳ 2 niên khoá 1
         * $XL_HK2_NK1 = Xếp loại Học kỳ 1 niên khoá 1
         */
        $points_HK2_NK1 = $this->getPoint(2, $nienkhoa1);
        $TBM_HK2_NK1 = $this->getTBM()
            ->where('lophocphans.hocky', 2)
            ->where('lophocphans.nienkhoa', $nienkhoa1)
            ->first();
        $XL_HK2_NK1 = $this->xeploai($TBM_HK2_NK1);
        $TC_NK1 =  $this->getTBM()
            ->where('lophocphans.nienkhoa', $nienkhoa1)
            ->first();



        // DD($TBTL_HK2_NK1);
        /**
         * Bảng điểm Học kỳ 1 niên khoá 2
         * $points_HK1_NK2 = Bảng điểm học 1 niên khoá 2
         * $TBM_HK1_NK2 = Trung bình môn học kỳ 1 niên khoá 2
         * $TBM_NK2 = Trung bình môn niên khoá 2
         * $TC_NK2 = Tín chỉ niên khoá 2
         * $XL_HK1_NK2 = Xếp loại Học kỳ 1 niên khoá 2
         * $XL_NK2 = Xếp loại niên khoá 2
         */
        $points_HK1_NK2 = $this->getPoint(1, $nienkhoa2);
        $TBM_HK1_NK2 = $this->getTBM()
            ->where('lophocphans.hocky', 1)
            ->where('lophocphans.nienkhoa', $nienkhoa2)
            ->first();
        // dd($TBM_HK1_NK2);
        $XL_HK1_NK2 = $this->xeploai($TBM_HK1_NK2);



        /**
         * Bảng điểm Học kỳ 2 niên khoá 2
         * $points_HK2_NK2 = Bảng điểm học 2 niên khoá 2
         * $TBM_HK2_NK2 = Trung bình môn học kỳ 2 niên khoá 2
         * $XL_HK2_NK2 = Xếp loại Học kỳ 2 niên khoá 2
         */
        $points_HK2_NK2 =  $this->getPoint(2, $nienkhoa2, $this->getStudent());
        $TBM_HK2_NK2 = $this->getTBM()
            ->where('lophocphans.hocky', 2)
            ->where('lophocphans.nienkhoa', $nienkhoa2)
            ->first();
        // DD($TBM_HK2_NK2);
        $XL_HK2_NK2 = $this->xeploai($TBM_HK2_NK2);
        $TC_NK2 =  $this->getTBM()
            ->where('lophocphans.nienkhoa', $nienkhoa2)
            ->first();


        /**
         * Bảng điểm Học kỳ 2 niên khoá 1
         * $points_HK1_NK3 = Bảng điểm học 1 niên khoá 3
         * $TBM_HK1_NK3 = Trung bình môn học kỳ 1 niên khoá 3
         * $TBM_NK3 = Trung bình môn niên khoá 3
         * $TC_NK3 = Tín chỉ niên khoá 3
         * $XL_HK1_NK3 = Xếp loại Học kỳ 1 niên khoá 3
         * $XL_NK3 = Xếp loại niên khoá 3
         */
        $points_HK1_NK3 =  $this->getPoint(1, $nienkhoa3);
        $TBM_HK1_NK3 = $this->getTBM()
            ->where('lophocphans.hocky', 1)
            ->where('lophocphans.nienkhoa', $nienkhoa3)
            ->FIRST();

        $TC_NK3 = $this->getTBM()
            ->where('lophocphans.nienkhoa', $nienkhoa3)
            ->first();

        $XL_HK1_NK3 = $this->xeploai($TBM_HK1_NK3);
        /*
            Niên khoá
        */
        $TBM_NK1 = $this->getTBM()
            ->where('lophocphans.nienkhoa', $nienkhoa1)
            ->first();
        $XL_NK1 = $this->xeploai($TBM_NK1);

        $TBM_NK2 = $this->getTBM()
            ->where('lophocphans.nienkhoa', $nienkhoa2)
            ->first();
        $XL_NK2 = $this->xeploai($TBM_NK2);

        $TBM_NK3 = $this->getTBM()
            ->where('lophocphans.nienkhoa', $nienkhoa3)
            ->first();
        $XL_NK3 = $this->xeploai($TBM_NK3);
        /**
         * Tích luỹ tốt nghiệp
         */
        $points_TN = $this->getTBM()->first();

        //TÍN CHỈ TÍCH LUỸ
            $TC_TL_HK1_NK1 = $TBM_HK1_NK1->TINCHI;
            $TC_TL_HK2_NK1 = $TC_NK1->TINCHI;
            $TC_TL_HK1_NK2 = $TC_NK1->TINCHI + $TBM_HK1_NK2->TINCHI;
            $TC_TL_HK2_NK2 = $TC_NK1->TINCHI + $TC_NK2->TINCHI;
            $TC_TL_HK1_NK3 = $TC_NK1->TINCHI + $TC_NK2->TINCHI + $TBM_HK1_NK3->TINCHI;

        //DTB TÍCH LUỸ
        if ($TC_TL_HK1_NK1 != 0) {
            $TBTL_HK1_NK2 = $this->getDTL(1, $nienkhoa2) /  $TC_TL_HK1_NK2;
            $TBTL_HK1_NK2_T4 = $this->getDTLT4(1, $nienkhoa2) /  $TC_TL_HK1_NK2;
        }else{
            $TBTL_HK1_NK2 = 0;
            $TBTL_HK1_NK2_T4 =0;
        }
        if ($TC_TL_HK2_NK2 != 0 ) {
            $TBTL_HK2_NK2 =  $this->getDTL(2, $nienkhoa2) /   $TC_TL_HK2_NK2;
            $TBTL_HK2_NK2_T4 = $this->getDTLT4(2, $nienkhoa2) /   $TC_TL_HK2_NK2;
        }else{
            $TBTL_HK2_NK2 = 0;
            $TBTL_HK2_NK2_T4 =0;
        }
        if ($TC_TL_HK2_NK1 != 0) {
            $TBTL_HK2_NK1 = $this->getDTL(2, $nienkhoa1) / $TC_TL_HK2_NK1;
            $TBTL_HK2_NK1_T4 = $this->getDTLT4(2, $nienkhoa1) / $TC_TL_HK2_NK1;
        }else{
            $TBTL_HK2_NK1 = 0;
            $TBTL_HK2_NK1_T4 =0;
        }if ($TC_TL_HK1_NK1 != 0) {
            $TBTL_HK1_NK1 = $this->getDTL(1, $nienkhoa1) / $TC_TL_HK1_NK1;
            $TBTL_HK1_NK1_T4 = $this->getDTLT4(1, $nienkhoa1) / $TC_TL_HK1_NK1;
        }else{
            $TBTL_HK1_NK1 = 0;
            $TBTL_HK1_NK1_T4 =0;
        }
        //XẾP LOẠI
        $XL_TL_HK2_NK1 = $this->getXLTL($TBTL_HK2_NK1_T4);
        $XL_TL_HK1_NK2 = $this->getXLTL($TBTL_HK1_NK2_T4);
        $XL_TL_HK2_NK2 = $this->getXLTL($TBTL_HK2_NK2_T4);
        $XL_TL_HK1_NK3 = $this->getXLTL($points_TN->tichluythang4);

        return view('livewire.teacher.list-score-of-teacher-component',
        [
            'student' =>   $this->student,
            'XL_TL_HK2_NK1' => $XL_TL_HK2_NK1,
            'XL_TL_HK1_NK2' => $XL_TL_HK1_NK2,
            'XL_TL_HK2_NK2' => $XL_TL_HK2_NK2,
            'XL_TL_HK1_NK3' => $XL_TL_HK1_NK3,

            'sv' => $sv,
            'title_scoreboard' => $title_scoreboard,
            'points_TN' => $points_TN,

            'points_HK1_NK1' => $points_HK1_NK1,
            'points_HK2_NK1' => $points_HK2_NK1,
            'points_HK1_NK2' => $points_HK1_NK2,
            'points_HK2_NK2' => $points_HK2_NK2,
            'points_HK1_NK3' => $points_HK1_NK3,

            'TBM_HK1_NK1' => $TBM_HK1_NK1,
            'TBM_HK2_NK1' => $TBM_HK2_NK1,
            'TBM_HK1_NK2' => $TBM_HK1_NK2,
            'TBM_HK2_NK2' => $TBM_HK2_NK2,
            'TBM_HK1_NK3' => $TBM_HK1_NK3,

            'TC_NK3' => $TC_NK3,
            'TC_NK2' => $TC_NK2,
            'TC_NK1' => $TC_NK1,

            'XL_HK1_NK1' => $XL_HK1_NK1,
            'XL_HK2_NK1' => $XL_HK2_NK1,
            'XL_HK1_NK2' => $XL_HK1_NK2,
            'XL_HK2_NK2' => $XL_HK2_NK2,
            'XL_HK1_NK3' => $XL_HK1_NK3,

            'nienkhoa1' => $nienkhoa1,
            'nienkhoa2' => $nienkhoa2,
            'nienkhoa3' => $nienkhoa3,

            'TBM_NK3' => $TBM_NK3,
            'TBM_NK2' => $TBM_NK2,
            'TBM_NK1' => $TBM_NK1,

            'XL_NK3' => $XL_NK3,
            'XL_NK2' => $XL_NK2,
            'XL_NK1' => $XL_NK1,

            'TBTL_HK2_NK2' => $TBTL_HK2_NK2,
            'TBTL_HK1_NK2' => $TBTL_HK1_NK2,
            'TBTL_HK2_NK1' => $TBTL_HK2_NK1,
            'TBTL_HK1_NK1' => $TBTL_HK1_NK1,

            'TBTL_HK2_NK2_T4' => $TBTL_HK2_NK2_T4,
            'TBTL_HK1_NK2_T4' => $TBTL_HK1_NK2_T4,
            'TBTL_HK2_NK1_T4' => $TBTL_HK2_NK1_T4,
            'TBTL_HK1_NK1_T4' => $TBTL_HK1_NK1_T4,

            'TC_TL_HK1_NK1'=>$TC_TL_HK1_NK1,
            'TC_TL_HK2_NK1'=>$TC_TL_HK2_NK1,
            'TC_TL_HK1_NK2'=>$TC_TL_HK1_NK2,
            'TC_TL_HK2_NK2'=>$TC_TL_HK2_NK2,
            'TC_TL_HK1_NK3'=>$TC_TL_HK1_NK3,
        ]
        )->layout('layouts.layout',
        ['title' => 'Trang Xem Điểm Học Phần']);
    }
}
