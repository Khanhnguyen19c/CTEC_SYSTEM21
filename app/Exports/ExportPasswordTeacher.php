<?php
namespace App\Exports;

use App\Models\Giangvien;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Sinhvien;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ExportPasswordTeacher implements  ShouldAutoSize,
WithDrawings,
 WithEvents,
 WithCustomStartCell,
FromView,
WithColumnWidths

{

    use Exportable;

    protected $ID_GIANGVIEN;

   public function __construct($ID_GIANGVIEN)
   {
       $this->ID_GIANGVIEN = $ID_GIANGVIEN;
   }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {
        try{
            $newpassword = Str::random(10);
            $teacher = Giangvien::join('users','users.code','=','giangvien.TENDANGNHAP')
            ->where('ID_GIANGVIEN',$this->ID_GIANGVIEN)->whereNull('giangvien.deleted_at')->first();

            $user = User::where('code',$teacher->TENDANGNHAP)->first();
            $user->password = Hash::make($newpassword);
            $user->save();
        }
       catch(ModelNotFoundException){
           return redirect()->back();
       }
        return view('exports.ResetPassForTeacher', [
            'teacher' => $teacher,
            'newpassword' => $newpassword,

        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 25,
            'C' => 15,
            'D' => 25,
            'E' => 25,
            'F' => 25,
            'G' => 15,

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
