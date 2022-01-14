<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Giangvien;
use App\Models\Khoa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Toastr;
class EditTeacherConponent extends Component
{
    use WithFileUploads;
    public $magv;
    public $name;
    public $sex;
    public $date;
    public $phone;
    public $email;
    public $address;
    public $username;
    public $thinhgiang;
    public $vanbang;
    public $image;
    public $department;
    public $nghiviec;
    public $theme;
    public $strquyen;
    public $ID_GIANGVIEN;
    public $newimage;

    private function validator(){
        return [
            'magv'=>'required',
            'name'=>'required',
            'sex'=>'required',
            'date'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'address' => 'required',
            'username'=>'required',
            'thinhgiang'=>'required',
            'vanbang'=>'required',
            'department'=>'required',
        ];
    }
    public function updated($fields){
        $this->validateOnly($fields,$this->validator());

    }

    public function mount($id){
        $teacher = Giangvien::where('ID_GIANGVIEN',$id)->first();
        $this->magv= $teacher->MAGV ;
        $this->name= $teacher->TEN;
        $this->sex = $teacher->PHAI ;
        $this->date = $teacher->NGAYSINH ;
        $this->phone = $teacher->SODIENTHOAI ;
        $this->email=  $teacher->EMAIL ;
        $this->address= $teacher->DIACHI;
        $this->username =  $teacher->TENDANGNHAP;
        $this->thinhgiang= $teacher->THINHGIANG;
        $this->vanbang = $teacher->VANBANG;
        $this->image = $teacher->HINHHOSO;
        $this->department = $teacher->ID_KHOA;
        $this->nghiviec = $teacher->NGHIVIEC;
        $this->theme = $teacher->THEME;
        $this->nghiviec = $teacher->NGHIVIEC;
        $this->strquyen = $teacher->SRINGQUYEN;
        $this->ID_GIANGVIEN = $id;
    }
    public function update_teacher(){
        $this->validate($this->validator());

        $teacher = Giangvien::where('ID_GIANGVIEN',$this->ID_GIANGVIEN)->first();
        $teacher->MAGV = $this->magv;
        $teacher->TEN = $this->name;
        $teacher->PHAI =$this->sex;
        $teacher->NGAYSINH = $this->date;
        $teacher->SODIENTHOAI = $this->phone;
        $teacher->EMAIL = $this->email;
        $teacher->DIACHI = $this->address;
        $teacher->TENDANGNHAP = $this->username;
        $teacher->THINHGIANG = $this->thinhgiang;
        $teacher->VANBANG = $this->vanbang;
        if($this->newimage){
            unlink('assets/images/Teachers' . '/' . $teacher->HINHHOSO);
            $imageName = Carbon::now()->timestamp. '.' . $this->newimage->extension();
            $this->newimage->storeAs('Teachers',$imageName);
            $teacher->HINHHOSO = $imageName;
        }
        $teacher->ID_KHOA = $this->department;
        $teacher->THEME =  0;
        $teacher->NGHIVIEC = 0;
        $teacher_user = User::where('code',$teacher->TENDANGNHAP)->first();
        $teacher_user->name = $this->name ;
        $teacher_user->email = $this->email;
        $teacher_user->code = $this->username;
        try{
            $teacher_user->save();
            $teacher->save();
        }catch(ModelNotFoundException){
            return Toastr::error('Lỗi cập nhật dữ liệu','Thất bại');
        }
        Toastr::success('Cập nhật dữ liệu giảng viên thành công','Thông báo');
        return redirect()->route('teacher_list');
    }
    public function render()
    {
        $departments = Khoa::whereNull('deleted_at')->get();
        return view('livewire.teacher.edit-teacher-conponent',[
            'departments'=>$departments
        ])->layout('layouts.layout',['title' => 'Trang Cập Nhật Thông Tin Giảng Viên CTEC']);
    }
}
