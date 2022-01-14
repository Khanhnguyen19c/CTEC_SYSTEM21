<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Bacdaotao;
use App\Models\Hedaotao;
use App\Models\Hocphan;
use App\Models\Khoa;
use Carbon\Carbon;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class ListModuleComponent extends Component
{
    use WithPagination;
    public $ID_KHOA;
    public $MAHOCPHAN;
    public $TENHOCPHAN;
    public $LOAIHOCPHAN;
    public $SOCHI;
    public $LYTHUYET;
    public $THUCHANH;
    public $ID_BACDAOTAO;
    public $ID_HEDAOTAO;
    public $ID_QUYCHEDAOTAO;
    public $GHICHU;

    public $ID_HOCPHAN;
    public $showEditModal;
    public $pageSize;
    public $search;

    public $KHOA_ID;
    private function validator(){
        return [
            'ID_KHOA'=>'required',
            'MAHOCPHAN'=>'required',
            'TENHOCPHAN'=>'required',
            'LOAIHOCPHAN'=>'required',
            'SOCHI'=>'required',
            'LYTHUYET'=>'required',
            'THUCHANH'=>'required',
            'ID_BACDAOTAO'=>'required',
            'ID_HEDAOTAO'=>'required',
            'ID_QUYCHEDAOTAO' => 'required',
            'GHICHU'=>'max:100',
         ];
     }
     //clear modal
     public function clearModal(){
        $this->ID_KHOA= '';
        $this->MAHOCPHAN= '';
        $this->TENHOCPHAN= '';
        $this->SOCHI= '';
        $this->LYTHUYET= '';
        $this->THUCHANH= '';
        $this->ID_BACDAOTAO= '';
        $this->ID_HEDAOTAO= '';
        $this->ID_QUYCHEDAOTAO= '';
        $this->GHICHU= '';
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
    Public function edit_module($id){
        $module = Hocphan::where('ID_HOCPHAN',$id)->first();
        $this->ID_HOCPHAN = $module->ID_HOCPHAN ;
        $this->ID_KHOA = $module->ID_KHOA ;
        $this->MAHOCPHAN = $module->MAHOCPHAN ;
        $this->TENHOCPHAN = $module->TENHOCPHAN ;
        $this->LOAIHOCPHAN = $module->LOAIHOCPHAN ;
        $this->SOCHI =  $module->SOCHI ;
        $this->THUCHANH = $module->THUCHANH ;
        $this->LYTHUYET = $module->LYTHUYET ;
        $this->ID_BACDAOTAO = $module->ID_BACDAOTAO ;
        $this->ID_HEDAOTAO = $module->ID_HEDAOTAO ;
        $this->ID_QUYCHEDAOTAO = $module->ID_QUYCHEDAOTAO;
        $this->GHICHU = $module->GHICHU ;
        $this->showEditModal = true;
        $this->dispatchBrowserEvent('show-form-edit');
    }
    public function update_module(){
        $this->validate($this->validator());
        $module = Hocphan::where('ID_HOCPHAN',$this->ID_HOCPHAN)->first();
        $module->ID_KHOA =$this->ID_KHOA;
        $module->MAHOCPHAN =$this->MAHOCPHAN;
        $module->TENHOCPHAN =$this->TENHOCPHAN;
        $module->LOAIHOCPHAN =$this->LOAIHOCPHAN;
        $module->SOCHI =$this->SOCHI;
        $module->THUCHANH =$this->THUCHANH;
        $module->LYTHUYET =$this->LYTHUYET;
        $module->ID_BACDAOTAO =$this->ID_BACDAOTAO;
        $module->ID_QUYCHEDAOTAO =$this->ID_QUYCHEDAOTAO;
        $module->ID_HEDAOTAO =$this->ID_HEDAOTAO;
        try {
        $module->save();
        } catch (ModelNotFoundException $exception) {
            return Toastr::error('Lỗi cập nhật dữ liệu','Thất bại');
        }
        $this->dispatchBrowserEvent('Toastr_message',['message'=>'Cập nhật khoa thành công']);
        $this->dispatchBrowserEvent('hide-form');
    }

    public function add_module(){
        $this->validate($this->validator());
        $module = new Hocphan();
        $module->ID_KHOA =$this->ID_KHOA;
        $module->MAHOCPHAN =$this->MAHOCPHAN;
        $module->TENHOCPHAN =$this->TENHOCPHAN;
        $module->LOAIHOCPHAN =$this->LOAIHOCPHAN;
        $module->SOCHI =$this->SOCHI;
        $module->THUCHANH =$this->THUCHANH;
        $module->LYTHUYET =$this->LYTHUYET;
        $module->ID_BACDAOTAO =$this->ID_BACDAOTAO;
        $module->ID_HEDAOTAO =$this->ID_HEDAOTAO;
        $module->ID_QUYCHEDAOTAO =$this->ID_QUYCHEDAOTAO;
        $module->GHICHU =$this->GHICHU;
        try {
        $module->save();
        } catch (ModelNotFoundException $exception) {
            return Toastr::error('Lỗi thêm dữ liệu','Thất bại');
        }
        $this->dispatchBrowserEvent('Toastr_message',['message'=>'Thêm học phần thành công']);
        $this->reset();
        $this->dispatchBrowserEvent('hide-form');
    }
    public function delete_module($id){
        $module = Hocphan::where('ID_HOCPHAN',$id)->first();
        $module->deleted_at = Carbon::now();
        try {
        $module->save();
    } catch (ModelNotFoundException $exception) {
        return Toastr::error('Lỗi xoá dữ liệu','Thất bại');
    }
        $this->dispatchBrowserEvent('Toastr_message',['message'=>'Xoá học phần thành công']);
    }

    public function mount(){
        $this->pageSize = 12;
        $this->ID_QUYCHEDAOTAO = 22;
    }
    public function render()
    {

        if($this->search){
            if($this->KHOA_ID){
            $modules = Hocphan::where('ID_KHOA',$this->KHOA_ID)
            ->where('TENHOCPHAN','LIKE','%'.$this->search.'%')
            ->Orwhere('MAHOCPHAN','LIKE','%'.$this->search.'%')
            ->whereNull('deleted_at')->paginate($this->pageSize);
            }else{
                $modules = Hocphan::where('TENHOCPHAN','LIKE','%'.$this->search.'%')
                ->Orwhere('MAHOCPHAN','LIKE','%'.$this->search.'%')
                ->whereNull('deleted_at')->paginate($this->pageSize);
            }
        }else{
            if($this->KHOA_ID){
                $modules = Hocphan::where('ID_KHOA',$this->KHOA_ID)
                ->whereNull('deleted_at')->paginate($this->pageSize);
            }else{
                $modules = Hocphan::whereNull('deleted_at')->paginate($this->pageSize);
            }

        }
        $bacdaotaos = Bacdaotao::whereNull('deleted_at')->get();
        $hedaotaos = Hedaotao::whereNull('deleted_at')->get();
        $khoas = Khoa::whereNull('deleted_at')->get();
        return view('livewire.teacher.list-module-component',[
            'modules' => $modules,
            'bacdaotaos' => $bacdaotaos,
            'hedaotaos' => $hedaotaos,
            'khoas' => $khoas,
        ])->layout('layouts.layout',['title' => 'Trang Quản Lý Học Phần CTEC']);
    }
}
