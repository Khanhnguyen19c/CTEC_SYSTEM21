<?php

namespace App\Http\Livewire;

use App\Models\ChatGroup;
use App\Models\Event;
use App\Models\Giangvien;
use App\Models\Sinhvien;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class BodyHeaderComponent extends Component
{
    protected $listeners = ['refreshComponent'=>'$refresh'];

    public $OLD_PASS;
    public $password;
    public $password_confirmation;
    public function change_pass(){
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
    public function render()
    {
        $time = Carbon::now()->format('y/m/d h:i:s');
        $event = Event::where('user_id',Auth::user()->id)->where('end','>=',$time)->get();
        $event_count = Event::where('user_id',Auth::user()->id)->where('end','>=',$time)->count();
        $chat_group_count = ChatGroup::where('receiver_id',Auth::user()->id)->whereNULL('is_seen')->count();

        $count = $event_count + $chat_group_count;
        $chat_group = ChatGroup::where('receiver_id',Auth::user()->id)->whereNULL('is_seen')->get();
        $profile_teacher = Giangvien::where('TENDANGNHAP',Auth::user()->code)->first();
        $profile = Sinhvien::where('MASV',Auth::user()->code)->first();
        return view('livewire.body-header-component',['count'=>$count,'chat_group'=>$chat_group,'event'=>$event,'profile'=>$profile,'profile_teacher'=>$profile_teacher]);
    }
}
