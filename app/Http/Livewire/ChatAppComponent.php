<?php

namespace App\Http\Livewire;

use App\Models\ChatGroup;
use App\Models\Lopchuyennganh;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Toastr;

class ChatAppComponent extends Component
{
    public $message;
    public $allmessages;
    public $sender;
    public $user_online;
    public $Search;

    public $tmp;
    public $teacher;
    public $sender_group;
    public $messages_group;

    public function mountdata()
    {
        if (isset($this->sender->id)) {
            $this->allmessages = ChatGroup::with('user')->where('user_id', auth()->id())
                ->where('receiver_id', $this->sender->id)->whereIn('status', [1, 2])
                ->orWhere('user_id', $this->sender->id)
                ->where('receiver_id', auth()->id())->orderBy('id', 'ASC')->get();
            $not_seen = ChatGroup::where('user_id', $this->sender->id)
                ->where('receiver_id', auth()->id());
            $not_seen->update(['is_seen' => true]);
        }
        if (isset($this->sender_group->ID_LOPCHUYENNGANH)) {
            $this->messages_group = ChatGroup::where('group_chat',$this->sender_group->ID_LOPCHUYENNGANH)
            ->whereIn('status', [1, 2])
            ->orderBy('id', 'ASC')->get();
        }
    }
    public function resetForm()
    {
        $this->message = '';
    }

    public function getUser($userId)
    {
        $user = User::where('users.id', $userId)->first();
        $this->sender = $user;
        $this->allmessages = ChatGroup::where('user_id', auth()->id())
            ->where('receiver_id', $userId)
            ->orWhere('user_id', $userId)
            ->where('receiver_id', auth()->id())
            ->orderBy('id', 'ASC')
            ->whereIn('status', [1, 2])->get();

        $this->user_online = User::where('is_online', 1)->where('id', $userId)->first();
        $this->sender_group = NULL;
        $this->messages_group = NULL;
    }
    public function getGroup($ID_LOPCHUYENNGANH)
    {
        $groupchat = Lopchuyennganh::where('ID_LOPCHUYENNGANH',$ID_LOPCHUYENNGANH)->first();
         $this->sender_group = $groupchat;

         $this->messages_group = ChatGroup::where('group_chat', $ID_LOPCHUYENNGANH)
         ->orderBy('id', 'ASC')
         ->whereIn('status', [1, 2])->get();

        $this->sender = NULL;
        $this->allmessages = null;
    }

    public function SendMessage()
    {
        $data = new ChatGroup;
        $data->messages = $this->message;
        $data->user_id = auth()->id();
        if($this->sender){
            $data->receiver_id = $this->sender->id;
        }else{
            $data->group_chat = $this->sender_group->ID_LOPCHUYENNGANH;
        }

        $data->status = 1;
        $data->save();
        $this->resetForm();
        $this->emitTo('body-header-component', 'refreshComponent');
    }

    //thu hồi
    public function restore($id, $status)
    {
        $chatgroup = ChatGroup::find($id);
        if ($status == 'restore') {
            $chatgroup->messages = "Đã Thu Hồi";
            $chatgroup->status = 2;
            $chatgroup->save();
        } elseif ($status == 'delete_at') {
            $chatgroup->status = 3;
            $chatgroup->deleted_at = Carbon::now();
            $chatgroup->save();
        } else {
            $chatgroup->delete();
        }

        $this->emitTo('body-header-component', 'refreshComponent');
    }


    public function render()
    {
        $sender = $this->sender;
        $this->allmessages;
        $Group = $this->sender_group;
        $this->messages_group;

        if (Auth::user()->utype == 'Student') {
            $tmp = DB::table('users')
                ->join('sinhviens', 'sinhviens.MASV', '=', 'users.code')
                ->where('users.id', auth()->user()->id)
                ->first();

            $Teacher = DB::table('users')
                ->join('giangvien', 'giangvien.TENDANGNHAP', '=', 'users.code')
                ->join('lopchuyennganhs', 'lopchuyennganhs.GVCN', 'giangvien.ID_GIANGVIEN')
                ->where('lopchuyennganhs.ID_LOPCHUYENNGANH', $tmp->ID_LOPCHUYENNGANH)
                ->whereNotIn('users.id', [Auth::user()->id])
                ->whereNull('users.deleted_at')->first();
            $class = Lopchuyennganh::where('ID_LOPCHUYENNGANH',  $tmp->ID_LOPCHUYENNGANH)->get();
        } else {
            $tmp = DB::table('users')
                ->join('giangvien', 'giangvien.TENDANGNHAP', '=', 'users.code')
                ->join('lopchuyennganhs', 'lopchuyennganhs.GVCN', 'giangvien.ID_GIANGVIEN')
                ->where('users.id', auth()->user()->id)
                ->first();
            if ($tmp == null) {
                return view('errors.404')->layout(
                    'layouts.layout',
                    ['title' => 'Chat App CTEC']
                );
            }
            $Teacher = null;
            $class = Lopchuyennganh::where('GVCN',  $tmp->GVCN)->get();
        }

        if ($this->Search) {
            $users = DB::table('users')
                ->join('sinhviens', 'sinhviens.MASV', '=', 'users.code')
                ->join('lopchuyennganhs', 'lopchuyennganhs.ID_LOPCHUYENNGANH', 'sinhviens.ID_LOPCHUYENNGANH')
                ->Orwhere('sinhviens.HODEM', 'LIKE', '%' . $this->Search . '%')
                ->Orwhere('sinhviens.TEN', 'LIKE', '%' . $this->Search . '%')
                ->Orwhere('sinhviens.MASV', 'LIKE', '%' . $this->Search . '%')
                ->Orwhere('users.name', 'LIKE', '%' . $this->Search . '%')
                ->where('sinhviens.ID_LOPCHUYENNGANH', $tmp->ID_LOPCHUYENNGANH)
                ->whereNotIn('users.id', [Auth::user()->id])
                ->whereNull('users.deleted_at')->get();
        } else {
            $users = DB::table('users')
                ->join('sinhviens', 'sinhviens.MASV', '=', 'users.code')
                ->join('lopchuyennganhs', 'lopchuyennganhs.ID_LOPCHUYENNGANH', 'sinhviens.ID_LOPCHUYENNGANH')
                ->where('sinhviens.ID_LOPCHUYENNGANH', $tmp->ID_LOPCHUYENNGANH)
                ->whereNotIn('users.id', [Auth::user()->id])
                ->whereNull('users.deleted_at')->get();
        }
        return view('livewire.chat-app-component', [
            'users' => $users,
            'sender' => $sender,
            'Teacher' => $Teacher,
            'class' => $class,
            'Group' => $Group,
        ])->layout(
            'layouts.layout',
            ['title' => 'Chat App CTEC']
        );
    }
}
