<?php

namespace App\Http\Livewire\Teacher;

use App\Exports\ExcelExportOfclass;
use App\Models\Giangvien;
use App\Models\Lopchuyennganh;
use App\Models\Sinhvien;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Excel;
use Livewire\WithPagination;
class ListClassOfTeacherComponent extends Component
{
    use WithPagination;

    public $title_class;
    public $MALOPCHUYENNGANH;
    public $Search;
    public $pageSize;
    public $ID;
    public  function mount(){
        $this->pageSize = 12 ;
    }

    public function render()
    {
        $teacher = Giangvien::whereHas('user', function($q)
        {
            $q->where('TENDANGNHAP',Auth::user()->code)->WhereNull('deleted_at');

        })->first();
        if($this->MALOPCHUYENNGANH){
            if($this->Search){
                $students = Sinhvien::join('lopchuyennganhs','sinhviens.ID_LOPCHUYENNGANH','=','lopchuyennganhs.ID_LOPCHUYENNGANH')
                ->where('lopchuyennganhs.MALOPCHUYENNGANH',$this->MALOPCHUYENNGANH)
                ->Orwhere('sinhviens.HODEM','LIKE','%'.$this->Search.'%')
                ->Orwhere('sinhviens.TEN','LIKE','%'.$this->Search.'%')
                ->Orwhere('sinhviens.MASV','LIKE','%'.$this->Search.'%')
                ->Orwhere('sinhviens.SOHOSO','LIKE','%'.$this->Search.'%')
                ->where('lopchuyennganhs.GVCN',$teacher->ID_GIANGVIEN)
                ->whereNull('sinhviens.deleted_at')
                ->paginate($this->pageSize);
            }else{
                $students = Sinhvien::join('lopchuyennganhs','sinhviens.ID_LOPCHUYENNGANH','=','lopchuyennganhs.ID_LOPCHUYENNGANH')
                ->where('lopchuyennganhs.GVCN',$teacher->ID_GIANGVIEN)
                ->where('lopchuyennganhs.MALOPCHUYENNGANH',$this->MALOPCHUYENNGANH)
                ->whereNull('sinhviens.deleted_at')
                ->paginate($this->pageSize);
            }
        }else{
            if($this->Search){
                $students = Sinhvien::join('lopchuyennganhs','sinhviens.ID_LOPCHUYENNGANH','=','lopchuyennganhs.ID_LOPCHUYENNGANH')
                ->Orwhere('sinhviens.HODEM','LIKE','%'.$this->Search.'%')
                ->Orwhere('sinhviens.TEN','LIKE','%'.$this->Search.'%')
                ->Orwhere('sinhviens.MASV','LIKE','%'.$this->Search.'%')
                ->Orwhere('sinhviens.SOHOSO','LIKE','%'.$this->Search.'%')
                ->where('lopchuyennganhs.GVCN',$teacher->ID_GIANGVIEN)
                ->whereNull('sinhviens.deleted_at')
                ->paginate($this->pageSize);
            }else{
                $students = Sinhvien::join('lopchuyennganhs','sinhviens.ID_LOPCHUYENNGANH','=','lopchuyennganhs.ID_LOPCHUYENNGANH')
                ->where('lopchuyennganhs.GVCN',$teacher->ID_GIANGVIEN)
                ->whereNull('sinhviens.deleted_at')
                ->paginate($this->pageSize);
            }

        }

        $title_class = Lopchuyennganh::where('GVCN',$teacher->ID_GIANGVIEN)->GET();

        $this->title_class = $title_class;
        $title = 'Trang Quản Lý Sinh Viên Lớp ';

        foreach($title_class as $key=> $title_cla){
            $title.= $title_cla->MALOPCHUYENNGANH;
            if ($key === 0) {
                $title.= '-';
            }
        }

        return view('livewire.teacher.list-class-of-teacher-component',[
            'students' => $students,
            'title_class'=> $title_class,
        ])->layout('layouts.layout',['title' => $title]);
    }
    public function export_DS(){
        if($this->MALOPCHUYENNGANH == NULL){
            return  $this->dispatchBrowserEvent('Toastr_message_error', ['message' => 'Bạn chưa chọn lớp cần xuất!!']);
        }
        return (new ExcelExportOfclass($this->MALOPCHUYENNGANH) )->download('Danh sách sinh viên Lớp '.$this->MALOPCHUYENNGANH.'.xlsx');
    }
}
