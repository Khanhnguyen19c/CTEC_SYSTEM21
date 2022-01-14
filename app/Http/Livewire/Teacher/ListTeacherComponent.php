<?php

namespace App\Http\Livewire\Teacher;

use App\Exports\ExportPassword;
use App\Exports\ExportPasswordTeacher;
use App\Models\Giangvien;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;
use Toastr;
class ListTeacherComponent extends Component
{
    //public $pagesize;
    public function delete_teacher($id){
        $teacher = Giangvien::where('ID_GIANGVIEN',$id)->first();
            $teacher->deleted_at = Carbon::now();
            $teacher->NGHIVIEC = 1;

            $user = User::where('code',$teacher->TENDANGNHAP)->first();
            $user->deleted_at = Carbon::now();
            try{
                $user->save();
                $teacher->save();
            }catch(ModelNotFoundException){
                return Toastr::error('Lỗi cập nhật dữ liệu','Thất bại');
            }
        Toastr::success('Cập nhật dữ liệu giảng viên thành công','Thông báo');
        return redirect()->back();
    }

    public function render()
    {
        // whereNull('delete_at')
        $teachers = Giangvien::all();
        return view('livewire.teacher.list-teacher-component',[
            'teachers' => $teachers
        ])->layout('layouts.layout',['title' => 'Trang Quản Lý Giảng Viên CTEC']);
    }

    public function resetPass($ID_GIANGVIEN){
        return (new  ExportPasswordTeacher($ID_GIANGVIEN))->download('File cấp mật khẩu cho giảng viên.xlsx');
    }
}
