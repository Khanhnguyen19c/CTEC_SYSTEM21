<?php

namespace App\Exports;

use App\Models\Khoa;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Sinhvien;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
class ExcelExport implements ShouldAutoSize, WithEvents,WithColumnWidths,FromView,WithCustomStartCell,WithDrawings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    protected $KHOA_ID;

   public function __construct($KHOA_ID)
   {
       $this->KHOA_ID = $KHOA_ID;
   }
    public function view(): View
    {

        $students = Sinhvien::WHERE('ID_KHOA',$this->KHOA_ID)->WHERENULL('deleted_at')->get();
        $KHOA = Khoa::where('ID_KHOA',$this->KHOA_ID)->WHERENULL('deleted_at')->FIRST();

        return view('exports.listAllStudent', [
            'students' => $students,
            'KHOA'=>$KHOA,
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
            'G' => 25,
            'I' => 25,
            'H' => 15,
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $cellRange = 'A12:H12'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
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
