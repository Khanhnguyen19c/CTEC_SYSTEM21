<?php

namespace App\Exports;

use App\Models\Ketquahocphan;
use App\Models\Lopchuyennganh;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\Sinhvien;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
Use \Maatwebsite\Excel\Sheet;
class ExcelExportScoreHK implements
    ShouldAutoSize,
    WithDrawings,
     WithEvents,
    WithCustomStartCell,
    FromView,
    WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public $student;
    public function __construct($student)
    {
        $this->student = $student;

    }
    public function getStudent()
    {
        if($this->student){
            $student = Sinhvien::where('ID_SINHVIEN',$this->student->ID_SINHVIEN)->first();
        }else{
            $student = Sinhvien::whereHas('user', function($q)
            {
                $q->where('MASV',Auth::user()->code)->WhereNull('deleted_at');

            })->first();
        }

        return $student;
    }
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

    public function getNDT(){
        $nienkhoa = Lopchuyennganh::where('ID_LOPCHUYENNGANH', $this->getStudent()->ID_LOPCHUYENNGANH)->FIRST();
        $khoa = $nienkhoa->NAMNHAPHOC;
        $sv = Carbon::now()->format('Y') - $khoa;
        return $sv;
    }
    public function getTBTL($hocky,$nienkhoa){
       return DB::table('sinhvienlophocphan')->select(DB::raw("SUM(ketquahocphan.TRUNGBINH10 * hocphans.SOCHI) as DTB, SUM(hocphans.SOCHI) as SOCHI,SUM(ketquahocphan.TRUNGBINH4 * hocphans.SOCHI) as tichluythang4"))
       ->leftJoin('ketquahocphan', function ($join) {
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

    public function getDTL($hocky,$nienkhoa){
        $TBTL = 0;
        $khoahoc = Lopchuyennganh::where('ID_LOPCHUYENNGANH', $this->getStudent()->ID_LOPCHUYENNGANH)->FIRST();
        $khoa = $khoahoc->NAMNHAPHOC; //2019
           $namNienKhoa = substr($nienkhoa,5,4); //2020
               for($i=$khoa;$i<$namNienKhoa;$i++)
               {

               $nk = $i."-".($i+1);
               if($nk!==$nienkhoa){
                   $TBTL=  $TBTL + round($this->getTBTL(1,$nk)->DTB,2) ;

                   $TBTL=  $TBTL + round($this->getTBTL(2,$nk)->DTB,2) ;
               }else{
                   if($hocky==1){
                       // DD($this->getTBTL(1,$nienkhoa));
                       $TBTL=  $TBTL+ round($this->getTBTL(1,$nk)->DTB,2) ;
                   }elseif($hocky==2){
                       $TBTL=  $TBTL + round($this->getTBTL(1,$nk)->DTB,2) ;

                       $TBTL=  $TBTL + round($this->getTBTL(2,$nk)->DTB,2) ;
                   }
               }
               }

               return $TBTL;
   }

   public function getXLTL($DTB){
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
   public function getDTLT4($hocky , $nienkhoa){
       $TBTL4 = 0;
       $khoahoc = Lopchuyennganh::where('ID_LOPCHUYENNGANH', $this->getStudent()->ID_LOPCHUYENNGANH)->FIRST();
       $khoa = $khoahoc->NAMNHAPHOC;
          $namNienKhoa = substr($nienkhoa,5,4);
          //NIEN KHOA 2020-2021
              for($i=$khoa; $i<$namNienKhoa;$i++){
                  $nk = $i."-".($i+1);
                  if($nienkhoa !== $nk){
                      $TBTL4 =  $TBTL4 + ($this->getTBTL(1,$nk)->tichluythang4 ) ;

                      $TBTL4 = ($TBTL4 + $this->getTBTL(2,$nk)->tichluythang4) ;
                  }else{

                      if($hocky==1){
                          $TBTL4=  ($TBTL4 + $this->getTBTL(1,$nk)->tichluythang4);
                      }elseif($hocky==2){
                          $TBTL4=  $TBTL4+($this->getTBTL(1,$nk)->tichluythang4 );

                          $TBTL4=  ($TBTL4+$this->getTBTL(2,$nk)->tichluythang4);
                      }
                  }
              }
              return $TBTL4;
  }
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

    public function view(): View
    {
        //lấy niên khoá các năm học
        $nienkhoa = Lopchuyennganh::where('ID_LOPCHUYENNGANH', $this->getStudent()->ID_LOPCHUYENNGANH)->FIRST();
        $khoa = $nienkhoa->NAMNHAPHOC;
        $nienkhoa1 = $khoa . "-" . ($khoa + 1);
        $nienkhoa2 = ($khoa + 1) . "-" . ($khoa + 2);
        $nienkhoa3 = ($khoa + 2) . "-" . ($khoa + 3);
        $TBM_HK1_NK1 = $this->getTBM()
        ->where('lophocphans.hocky', 1)
        ->where('lophocphans.nienkhoa', $nienkhoa1)
        ->first();
        $TBM_HK1_NK1 = $this->getTBM()
                ->where('lophocphans.hocky', 1)
                ->where('lophocphans.nienkhoa', $nienkhoa1)
                ->first();
        $TBM_HK2_NK1 = $this->getTBM()
        ->where('lophocphans.hocky', 2)
        ->where('lophocphans.nienkhoa', $nienkhoa1)
        ->first();
        $TBM_HK1_NK2 = $this->getTBM()
                ->where('lophocphans.hocky', 1)
                ->where('lophocphans.nienkhoa', $nienkhoa2)
                ->first();
        $TBM_HK2_NK2 = $this->getTBM()
        ->where('lophocphans.hocky', 2)
        ->where('lophocphans.nienkhoa', $nienkhoa2)
        ->first();
        $TBM_HK1_NK3 = $this->getTBM()
        ->where('lophocphans.hocky', 1)
        ->where('lophocphans.nienkhoa', $nienkhoa3)
        ->first();

        $TC_NK3 = $this->getTBM()
        ->where('lophocphans.nienkhoa', $nienkhoa3)
        ->first();

        $TC_NK2 = $this->getTBM()
            ->where('lophocphans.nienkhoa', $nienkhoa2)
            ->first();

        $TC_NK1 =  $this->getTBM()
        ->where('lophocphans.nienkhoa', $nienkhoa1)
        ->first();
        $TBTL_HK1_NK1 = $this->getDTL(1,$nienkhoa1) / $TBM_HK1_NK1->TINCHI;
        $TBTL_HK1_NK1_T4 = $this->getDTLT4(1,$nienkhoa1) / $TBM_HK1_NK1->TINCHI;

        $TBTL_HK2_NK1 = $this->getDTL(2,$nienkhoa1) / $TC_NK1->TINCHI;
        $TBTL_HK2_NK1_T4 = $this->getDTLT4(2,$nienkhoa1) / $TC_NK1->TINCHI;

        $TBTL_HK1_NK2 = $this->getDTL(1,$nienkhoa2) / ($TBM_HK1_NK2->TINCHI + $TC_NK1->TINCHI);
        $TBTL_HK1_NK2_T4 = $this->getDTLT4(1,$nienkhoa2) / ($TBM_HK1_NK2->TINCHI +$TC_NK1->TINCHI);

        $TBTL_HK2_NK2 =  $this->getDTL(2,$nienkhoa2) / ($TC_NK2->TINCHI+$TC_NK1->TINCHI);
        $TBTL_HK2_NK2_T4 = $this->getDTLT4(2,$nienkhoa2) / ($TC_NK2->TINCHI+$TC_NK1->TINCHI);

        $TBTL_HK1_NK3 =  $this->getDTL(1,$nienkhoa3) / ($TC_NK2->TINCHI+$TC_NK1->TINCHI + $TC_NK3->TINCHI);
        $TBTL_HK1_NK3_T4 =  $this->getDTLT4(1,$nienkhoa3) / ($TC_NK2->TINCHI+$TC_NK1->TINCHI + $TC_NK3->TINCHI);

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

            $XL_HK1_NK1 = $this->xeploai($TBM_HK1_NK1);
            $XL_HK2_NK1 = $this->xeploai($TBM_HK2_NK1);
            $XL_HK1_NK2 = $this->xeploai($TBM_HK1_NK2);
            $XL_HK2_NK2 = $this->xeploai($TBM_HK2_NK2);
            $XL_HK1_NK3 = $this->xeploai($TBM_HK1_NK3);

            $XL_TL_HK2_NK1 = $this->getXLTL($TBTL_HK2_NK1_T4);
            $XL_TL_HK1_NK2 = $this->getXLTL($TBTL_HK2_NK1_T4);
            $XL_TL_HK2_NK2 = $this->getXLTL($TBTL_HK2_NK2_T4);
            $XL_TL_HK1_NK3 = $this->getXLTL($TBTL_HK1_NK3_T4);

            $TC_TL_HK1_NK1 = $TBM_HK1_NK1->TINCHI;
            $TC_TL_HK2_NK1 = $TC_NK1->TINCHI;
            $TC_TL_HK1_NK2 = $TC_NK1->TINCHI + $TBM_HK1_NK2->TINCHI;
            $TC_TL_HK2_NK2 = $TC_NK1->TINCHI + $TC_NK2->TINCHI;
            $TC_TL_HK1_NK3 = $TC_NK1->TINCHI + $TC_NK2->TINCHI + $TBM_HK1_NK3->TINCHI;
            // DD($this->getTBM(1,$nienkhoa3));
        return view('exports.transcript_HK', [
            'XL_TL_HK2_NK1'=> $XL_TL_HK2_NK1,
            'XL_TL_HK1_NK2'=> $XL_TL_HK1_NK2,
            'XL_TL_HK2_NK2'=> $XL_TL_HK2_NK2,
            'XL_TL_HK1_NK3'=> $XL_TL_HK1_NK3,

            'nienkhoa1' =>$nienkhoa1,
            'nienkhoa2' =>$nienkhoa2,
            'nienkhoa3' =>$nienkhoa3,
            'points_hk1_nk1' => $this->getPoint(1,$nienkhoa1),
            'points_hk2_nk1' => $this->getPoint(2,$nienkhoa1),
            'points_hk1_nk2' => $this->getPoint(1,$nienkhoa2),
            'points_hk2_nk2' => $this->getPoint(2,$nienkhoa2),
            'points_hk1_nk3' => $this->getPoint(1,$nienkhoa3),

            'TBM_HK1_NK1' =>  $TBM_HK1_NK1,
            'TBM_HK2_NK1' =>  $TBM_HK2_NK1,
            'TBM_HK1_NK2' =>  $TBM_HK1_NK2,
            'TBM_HK2_NK2' =>  $TBM_HK2_NK2,
            'TBM_HK1_NK3' =>  $TBM_HK1_NK3,

            'tc_nk1'=> $TC_NK1,
            'tc_nk2'=> $TC_NK2,
            'tc_nk3'=> $TC_NK3,

            'TBTL_HK1_NK1'=>$TBTL_HK1_NK1,
            'TBTL_HK1_NK1_T4'=>$TBTL_HK1_NK1_T4,

            'TBTL_HK2_NK1'=>$TBTL_HK2_NK1,
            'TBTL_HK2_NK1_T4'=>$TBTL_HK2_NK1_T4,

            'TBTL_HK1_NK2'=>$TBTL_HK1_NK2,
            'TBTL_HK1_NK2_T4'=>$TBTL_HK1_NK2_T4,

            'TBTL_HK2_NK2'=>$TBTL_HK2_NK2,
            'TBTL_HK2_NK2_T4'=>$TBTL_HK2_NK2_T4,

            'TBTL_HK1_NK3'=>$TBTL_HK1_NK3,
            'TBTL_HK1_NK3_T4'=>$TBTL_HK1_NK3_T4,

            'XL_NK1'=>$XL_NK1,
            'XL_NK2'=>$XL_NK2,
            'XL_NK3'=>$XL_NK3,

            'XL_HK1_NK1' => $XL_HK1_NK1,
            'XL_HK2_NK1' => $XL_HK2_NK1,
            'XL_HK1_NK2' => $XL_HK1_NK2,
            'XL_HK2_NK2' => $XL_HK2_NK2,
            'XL_HK1_NK3' => $XL_HK1_NK3,

            'student' =>$this->getStudent(),
            'sv'=>$this->getNDT(),
            'TC_TL_HK1_NK1'=>$TC_TL_HK1_NK1,
            'TC_TL_HK2_NK1'=>$TC_TL_HK2_NK1,
            'TC_TL_HK1_NK2'=>$TC_TL_HK1_NK2,
            'TC_TL_HK2_NK2'=>$TC_TL_HK2_NK2,
            'TC_TL_HK1_NK3'=>$TC_TL_HK1_NK3,
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 15,
            'C' => 25,
            'D' => 15,
            'E' => 15,
            'F' => 15,
            'G' => 15,
            'I' => 15,
            'H' => 15,
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $cellRange = 'A12:H12'; // All headers
                $event->sheet->getStyle($cellRange)->getFont()->setBold(true)->setSize(12);

            },
        ];
    }
    public function startCell(): string
    {
        return 'A12';
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/assets/images/logo/ctec_logo.png'));
        $drawing->setHeight(150);
        $drawing->setCoordinates('A4');
        return $drawing;
    }

}

