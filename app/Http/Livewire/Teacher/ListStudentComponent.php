<?php

namespace App\Http\Livewire\Teacher;

use App\Exports\ExcelExport;
use App\Imports\ExcelImport;
use App\Models\Khoa;
use App\Models\Sinhvien;
use Livewire\Component;
use Excel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Toastr;
class ListStudentComponent extends Component
{
    public $KHOA_ID;
    public function export_student(){
        if($this->KHOA_ID){
            $KHOA = Khoa::where('ID_KHOA',$this->KHOA_ID)->WHERENULL('deleted_at')->FIRST();
            return(new ExcelExport($this->KHOA_ID))->download('Danh sách sinh viên khoa '.$KHOA->TENKHOA.'.xlsx');
        }else{
                return  $this->dispatchBrowserEvent('Toastr_message_error', ['message' => 'Vui lòng chọn khoa trước khi thống kê!!']);
        }

    }
    public function import(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ExcelImport, $path);
        Toastr::success('Thêm dữ liệu sinh viên thành công','Thông báo');
        return Redirect()->back();
    }
    public function render()
    {
        $students = Sinhvien::wherenull('XOATEN')->Orwhere('XOATEN',0)->get();
        $khoa = Khoa::whereNull('deleted_at')->get();
        return view('livewire.teacher.list-student-component',[
            'students' => $students,
            'khoa' =>$khoa
        ])->layout('layouts.layout',['title' => 'Trang Quản Lý Sinh Viên CTEC']);
    }
}
