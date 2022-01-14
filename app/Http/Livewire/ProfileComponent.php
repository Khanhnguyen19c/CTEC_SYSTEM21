<?php

namespace App\Http\Livewire;

use App\Models\Profile;
use App\Models\Sinhvien;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Toastr;
class ProfileComponent extends Component
{
    public $SODIENTHOAI;
    public $DIACHILIENLAC;
    public $EMAIL;
    public $CMND;
    public $SOTKNGANHANG;

    public $OLD_PASS;
    public $password;
    public $password_confirmation;
    public function updated($fields){
        $this->validateOnly($fields,[
            'OLD_PASS'=>'required|min:6|max:32',
            'password'=>'required|confirmed|min:6|max:32',
            'SODIENTHOAI'=>'required',
            'DIACHILIENLAC'=>'required',
            'EMAIL'=>'required|email',
            'CMND'=>'required|numeric',
        ]);
    }

    public function mount(){
        $student = Sinhvien::where('MASV',Auth::user()->code)->first();

        $this->SODIENTHOAI = $student->SODIENTHOAI;
        $this->DIACHILIENLAC = $student->DIACHILIENLAC;
        $this->EMAIL = $student->EMAIL;
        $this->CMND = $student->CMND;
        $this->SOTKNGANHANG = $student->SOTKNGANHANG;
    }

    public function update_pass(){
        $this->validate([
            'OLD_PASS'=>'required|min:6|max:32',
            'password'=>'required|confirmed|min:6|max:32'
        ]);
        $student = User::where('code',Auth::user()->code)->first();
        if(Hash::check($this->OLD_PASS, $student->password)){
            if($this->OLD_PASS == $this->password){
                $this->dispatchBrowserEvent('Toastr_message_error', ['message' => 'Mời bạn nhập một mật khẩu khác']);
            }else{
                $student->password = Hash::make($this->password);
                $student->save();
                $this->dispatchBrowserEvent('Toastr_message', ['message' => 'Cập nhật mật khẩu thành công']);
                $this->dispatchBrowserEvent('hide-form');
                $this->reset();
            }
        }else{
            $this->dispatchBrowserEvent('Toastr_message_error', ['message' => 'Mật khẩu cũ bạn nhập không chính xác']);
        }
    }
    public function update_profile(){
        $this->validate([
            'SODIENTHOAI'=>'max:20',
            'DIACHILIENLAC'=>'max:100',
            'EMAIL'=>'max:50',
            'CMND'=>'max:50',
        ]);
        $student = Sinhvien::where('MASV',Auth::user()->code)->first();
        $student->SODIENTHOAI = $this->SODIENTHOAI;
        $student->DIACHILIENLAC = $this->DIACHILIENLAC;
        $student->EMAIL = $this->EMAIL;
        $student->CMND = $this->CMND;
        $student->SOTKNGANHANG = $this->SOTKNGANHANG;
        try{
            $student->save();
        }catch(ModelNotFoundException){
            return toastr::error('Toastr_message','Lỗi cập nhật','Thất bại');
        }
        $this->dispatchBrowserEvent('Toastr_message', ['message' => 'Cập nhật dữ liệu thành công']);
        $this->dispatchBrowserEvent('hide-form');
    }
    public function render()
    {
        $profile = Sinhvien::where('MASV',Auth::user()->code)->first();
        return view('livewire.profile-component',[
            'profile' => $profile
        ])->layout('layouts.layout',
        ['title' => 'Thông Tin Cá Nhân '.Auth()->user()->name .'-'.Auth()->user()->sinhvien->lopchuyennganh->MALOPCHUYENNGANH]);
    }
}
