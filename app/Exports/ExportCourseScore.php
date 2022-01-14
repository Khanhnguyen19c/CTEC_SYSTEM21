<?php

namespace App\Exports;

use App\Models\Ketquahocphan;
use App\Models\Lopchuyennganh;
use App\Models\Lophocphan;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\Sinhvien;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
Use \Maatwebsite\Excel\Sheet;
class ExportCourseScore implements
    ShouldAutoSize,
    WithDrawings,
     WithEvents,
    WithCustomStartCell,
    FromView,
    WithColumnWidths
{
    use exportable;


    /**
    * @return \Illuminate\Support\Collection
    */

    public $ID_LOPHOCPHAN;
    public function __construct($ID_LOPHOCPHAN)
    {
        $this->ID_LOPHOCPHAN = $ID_LOPHOCPHAN;

    }

    public function view(): View
    {
        $title_score = Lophocphan::where('lophocphans.ID_LOPHOCPHAN',$this->ID_LOPHOCPHAN)
        ->WhereNull('lophocphans.deleted_at')->first();
        $course_score = Lophocphan::join('ketquahocphan','ketquahocphan.ID_LOPHOCPHAN','lophocphans.ID_LOPHOCPHAN')
            ->where('lophocphans.ID_LOPHOCPHAN',$this->ID_LOPHOCPHAN)
            ->join('sinhviens','sinhviens.ID_SINHVIEN','ketquahocphan.ID_SINHVIEN')
            ->join('hocphans','hocphans.ID_HOCPHAN','lophocphans.ID_HOCPHAN')
            ->WhereNull('lophocphans.deleted_at')->WhereNull('ketquahocphan.deleted_at')->get();
        return view('exports.CourseScore', [
            'course_score' => $course_score,
            'title_score'=> $title_score,
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 15,
            'C' => 25,
            'D' => 15,
            'E' => 8,
            'F' => 8,
            'G' => 8,
            'I' => 8,
            'H' => 8,
            'J' => 8,
            'K' => 8,
            'L' => 15,
            'M' => 15,
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

