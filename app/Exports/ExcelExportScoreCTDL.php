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
class ExcelExportScoreCTDL implements
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
    public function getScores()
    {

       $score=   DB::table('sinhvienlophocphan')
       ->leftJoin('ketquahocphan', function ($join) {
           $join->on('sinhvienlophocphan.ID_LOPHOCPHAN', '=', 'ketquahocphan.ID_LOPHOCPHAN');
           $join->on('sinhvienlophocphan.ID_SINHVIEN','=','ketquahocphan.ID_SINHVIEN');
       })
   ->join('lophocphans', 'lophocphans.ID_LOPHOCPHAN', '=', 'sinhvienlophocphan.ID_LOPHOCPHAN')
   ->join('hocphans', 'hocphans.ID_HOCPHAN', '=', 'lophocphans.ID_HOCPHAN')
   ->join('giangvien', 'giangvien.ID_GIANGVIEN', '=', 'lophocphans.ID_GIAOVIEN')
   ->WhereNULL('lophocphans.deleted_at')
   ->WhereNULL('ketquahocphan.deleted_at')
   ->Where('sinhvienlophocphan.ID_SINHVIEN', $this->getStudent()->ID_SINHVIEN)
   ->get();
        return $score;
    }

    public function getNDT(){
        $nienkhoa = Lopchuyennganh::where('ID_LOPCHUYENNGANH', $this->getStudent()->ID_LOPCHUYENNGANH)->FIRST();
        $khoa = $nienkhoa->NAMNHAPHOC;
        $sv = Carbon::now()->format('Y') - $khoa;
        return $sv;
    }
    public function getDTN(){
        $points_TN =DB::table('sinhvienlophocphan')
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
        return $points_TN;
    }
    public function view(): View
    {
        return view('exports.transcript_CTDL', [
            'scores' => $this->getScores(),
            'student' =>$this->getStudent(),
            'points_TN' =>$this->getDTN(),
            'sv'=>$this->getNDT()
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
            }
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

