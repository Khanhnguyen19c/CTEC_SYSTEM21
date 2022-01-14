<?php

namespace App\Exports;

use App\Models\Giangvien;
use App\Models\Lopchuyennganh;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
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

class ExcelExportOfclass implements
ShouldAutoSize, WithEvents,WithColumnWidths,FromView,WithCustomStartCell,WithDrawings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    protected $MALOPCHUYENNGANH;

   public function __construct($MALOPCHUYENNGANH)
   {
       $this->MALOPCHUYENNGANH = $MALOPCHUYENNGANH;
   }
    public function getStudent()
    {
        $teacher = Giangvien::whereHas('user', function($q)
        {
            $q->where('TENDANGNHAP',Auth::user()->code)->WhereNull('deleted_at');

        })->first();

        return Sinhvien::join('lopchuyennganhs','sinhviens.ID_LOPCHUYENNGANH','=','lopchuyennganhs.ID_LOPCHUYENNGANH')
        ->where('lopchuyennganhs.GVCN',$teacher->ID_GIANGVIEN)
        ->where('lopchuyennganhs.MALOPCHUYENNGANH',$this->MALOPCHUYENNGANH)
        ->get();

    }
    public function view(): View
    {
        $TITLE = Lopchuyennganh::WHERE('MALOPCHUYENNGANH',$this->MALOPCHUYENNGANH)->FIRST();
        return view('exports.listStudent', [
            'students' => $this->getStudent(),
            'TITLE' => $TITLE,
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
