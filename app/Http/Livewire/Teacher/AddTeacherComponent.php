<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Giangvien;
use App\Models\Khoa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Livewire\WithFileUploads;
use Toastr;
class AddTeacherComponent extends Component
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
    public $password;
    public $thinhgiang;
    public $vanbang;
    public $image;
    public $department;

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
            'password'=>'required|min:8',
            'vanbang'=>'required',
            'image'=>'max:1024',
            'department'=>'required',
        ];
    }
    public function updated($fields){
        $this->validateOnly($fields,$this->validator());
    }

    public function add_teacher(){
        $this->validate($this->validator());
            $teacher = new Giangvien();
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
            if($this->image){
                $imageName = Carbon::now()->timestamp. '.' . $this->image->extension();
                $this->image->storeAs('Teachers',$imageName);
                $teacher->HINHHOSO = $imageName;
            }
            $teacher->ID_KHOA = $this->department;
            $teacher->THEME =  0;
            $teacher->NGHIVIEC = 0;

                $teacher_user = new User();
                $teacher_user->name = $this->name ;
                $teacher_user->email = $this->email;
                $teacher_user->code = $this->username;
                $teacher_user->password = Hash::make($this->password);
                $teacher_user->utype = 'Teacher';
            try{
                $teacher_user->save();
                $teacher->save();
            }catch(ModelNotFoundException){
                return Toastr::error('Lỗi thêm dữ liệu','Thất bại');
            }
        Toastr::success('Thêm dữ liệu giảng viên thành công','Thông báo');
        return Redirect()->route('teacher_list');
    }
    public function render()
    {
        $departments  = Khoa::whereNull('deleted_at')->get();
        return view('livewire.teacher.add-teacher-component',[
            'departments' => $departments
        ])->layout('layouts.layout',['title' => 'Trang Thêm Giảng Viên CTEC']);
    }
}
