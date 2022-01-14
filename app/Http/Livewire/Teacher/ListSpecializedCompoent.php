<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Bacdaotao;
use App\Models\Chuyennganh;
use App\Models\Hedaotao;
use App\Models\Nganh;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Toastr;
use Livewire\WithPagination;
class ListSpecializedCompoent extends Component
{
    use WithPagination;
    public $ID_BACDAOTAO;
    public $ID_HEDAOTAO;
    public $SONAMDAOTAO;
    public $MATUYENSINHCN;
    public $TENVIETTAT;
    public $MACHUYENNGANH;
    public $MANGANH;
    public $ID_CHUYENNGANH;
    public $showEditModal ;
    public $GHICHU;

    public $Search;
    public $pageSize;

    private function validator(){
        return [
            'ID_BACDAOTAO' => 'required',
            'ID_HEDAOTAO' => 'required',
            'SONAMDAOTAO' => 'required',
            'MATUYENSINHCN' => 'required|max:10',
            'TENVIETTAT' => 'required|max:20',
            'MACHUYENNGANH' => 'required',
            'MANGANH' => 'required',
         ];
     }
     public function mount(){
        $this->pageSize = 12 ;
     }
      //clear modal
      public function clearModal(){
        $this->ID_BACDAOTAO= '';
        $this->ID_HEDAOTAO= '';
        $this->SONAMDAOTAO= '';
        $this->MATUYENSINHCN= '';
        $this->TENVIETTAT= '';
        $this->MACHUYENNGANH= '';
        $this->MANGANH= '';
        $this->ID_CHUYENNGANH= '';
        $this->showEditModal = '';
        $this->showEditModal =false;
        $this->resetErrorBag();
        $this->resetValidation();
    }
    public function show_add(){
        $this->clearModal();
        $this->dispatchBrowserEvent('show-form-add');
    }
    public function updated($fields){
        $this->validateOnly($fields,$this->validator());
    }
    public function edit_specialized($id){
        $specialized = Chuyennganh::where('ID_CHUYENNGANH',$id)->first();
        $this->ID_BACDAOTAO = $specialized->ID_BACDAOTAO;
        $this->ID_HEDAOTAO = $specialized->ID_HEDAOTAO;
        $this->SONAMDAOTAO = $specialized->SONAMDAOTAO;
        $this->MATUYENSINHCN = $specialized->MATUYENSINHCN;
        $this->TENVIETTAT = $specialized->TENVIETTAT;
        $this->MACHUYENNGANH = $specialized->MACHUYENNGANH;
        $this->MANGANH = $specialized->ID_NGANH;
        $this->ID_CHUYENNGANH = $specialized->ID_CHUYENNGANH;
        $this->showEditModal = true;
        $this->dispatchBrowserEvent('show-form-edit');
    }
    public function update_specialized(){
        $this->validate($this->validator());
        $specialized = Chuyennganh::where('ID_CHUYENNGANH',$this->ID_CHUYENNGANH)->first();
        $specialized->ID_BACDAOTAO =$this->ID_BACDAOTAO;
        $specialized->ID_HEDAOTAO = $this->ID_HEDAOTAO;
        $specialized->SONAMDAOTAO = $this->SONAMDAOTAO;
        $specialized->MATUYENSINHCN = $this->MATUYENSINHCN;
        $specialized->TENVIETTAT = $this->TENVIETTAT;
        $specialized->MACHUYENNGANH = $this->MACHUYENNGANH;
        $specialized->ID_NGANH = $this->MANGANH;
        $specialized->GHICHU =$this->GHICHU;
        try {
        $specialized->save();
        } catch (ModelNotFoundException $exception) {
            return Toastr::error('Lỗi cập nhật dữ liệu','Thất bại');
        }
        $this->dispatchBrowserEvent('Toastr_message',['message'=>'Cập nhật chuyên ngành thành công']);
        $this->dispatchBrowserEvent('hide-form');
    }

    public function add_specialized(){
        $this->validate($this->validator());
        $specialized = new Chuyennganh();
        $specialized->ID_BACDAOTAO =$this->ID_BACDAOTAO;
        $specialized->ID_HEDAOTAO = $this->ID_HEDAOTAO;
        $specialized->SONAMDAOTAO = $this->SONAMDAOTAO;
        $specialized->MATUYENSINHCN = $this->MATUYENSINHCN;
        $specialized->TENVIETTAT = $this->TENVIETTAT;
        $specialized->MACHUYENNGANH = $this->MACHUYENNGANH;
        $specialized->ID_NGANH = $this->MANGANH;
        $specialized->GHICHU =$this->GHICHU;
        try {
        $specialized->save();
        } catch (ModelNotFoundException $exception) {
            return Toastr::error('Lỗi thêm dữ liệu','Thất bại');
        }
        $this->dispatchBrowserEvent('Toastr_message',['message'=>'Thêm chuyên ngành thành công']);
        $this->reset();
        $this->dispatchBrowserEvent('hide-form');
    }
    public function delete_specialized($id){
        $specialized = Chuyennganh::where('ID_CHUYENNGANH',$id)->first();
        $specialized->deleted_at = Carbon::now();
        try {
        $specialized->save();
        } catch (ModelNotFoundException $exception) {
            return Toastr::error('Lỗi xoá dữ liệu','Thất bại');
        }
        $this->dispatchBrowserEvent('Toastr_message',['message'=>'Xoá chuyên ngành thành công']);
    }

    public function refresh(){

    }
    public function render()
    {

        $nganhs = Nganh::whereNull('deleted_at')->get();
        $hedaotaos = Hedaotao::all();
        $bacdaotaos = Bacdaotao::all();
        if($this->Search){
            $specializeds = Chuyennganh::whereNull('deleted_at')
            ->Where('MACHUYENNGANH','LIKE','%'.$this->Search.'%')
            ->Orwhere('TENVIETTAT','LIKE','%'.$this->Search.'%')
            ->paginate($this->pageSize);

        }else{
            $specializeds = Chuyennganh::whereNull('deleted_at')->paginate($this->pageSize);
        }

        return view('livewire.teacher.list-specialized-compoent',[
            'specializeds' => $specializeds,
            'hedaotaos'=>$hedaotaos,
            'bacdaotaos' =>$bacdaotaos,
            'nganhs' => $nganhs,
        ])->layout('layouts.layout',['title' => 'Trang Quản Lý Chuyên Ngành CTEC']);
    }
}
