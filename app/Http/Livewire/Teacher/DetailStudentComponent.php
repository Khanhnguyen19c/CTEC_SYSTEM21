<?php

namespace App\Http\Livewire\Teacher;

use App\Exports\ExportPassword;
use App\Models\Sinhvien;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Toastr;
class DetailStudentComponent extends Component
{
    public $ID_SINHVIEN;

    public function mount($ID_SINHVIEN){
        $this->ID_SINHVIEN = $ID_SINHVIEN;
    }

    public function update_canhbaohv($student_id,$status){
        $student = Sinhvien::where('ID_SINHVIEN',$student_id)->first();
        if($status == 1){
            $student->CANHBAOHV = $status;
        }elseif($status == 2){
            $student->XOATEN = 1;
            $student->GHICHU = 'Đã xoá tên';
            $student->CANHBAOHV = $status;
            $student->deleted_at = Carbon::now();
        }else{
            $student->DATOTNGHIEP = 1;
        }
        try{
            $student->save();
        }catch(ModelNotFoundException){
            return Toastr::error('Lỗi xoá dữ liệu','Thất bại');
        }
        Toastr::success('Thay đổi trạng thái sinh viên thành công','Thông báo');
    }
    public function render()
    {
        $student = Sinhvien::where('ID_SINHVIEN',$this->ID_SINHVIEN)->whereNull('deleted_at')->first();
        return view('livewire.teacher.detail-student-component',[
            'student' => $student
        ])->layout('layouts.layout',['title' => 'Thông Tin Sinh Viên '.$student->name.' '.$student->MALOPCHUYENNGANH]);
    }

    public function export_password($id_sinhvien){
        return (new  ExportPassword($id_sinhvien))->download('File Cấp Mật Khẩu.xlsx');
    }
}
