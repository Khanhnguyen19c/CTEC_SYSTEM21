<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Bacdaotao;
use App\Models\Hedaotao;
use App\Models\Khoa;
use App\Models\Nganh;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Toastr;
class ListBranchComponent extends Component
{
    use WithPagination;
    public $ID_BACDAOTAO;
    public $ID_HEDAOTAO;
    public $MANGANH;
    public $TENNGANH;
    public $ID_KHOA;
    public $GHICHU;
    public $ID_NGANH;
    public $showEditModal ;

    public $Search;
    public $pageSize;

    public function mount(){
        $this->pageSize = 12;
     }
    private function validator(){
        return [
            'ID_BACDAOTAO'=>'required',
            'ID_HEDAOTAO'=>'required',
            'MANGANH'=>'required',
            'TENNGANH'=>'required',
            'ID_KHOA'=>'required',
         ];
     }
     //clear modal
     public function clearModal(){
        $this->showEditModal = false;
        $this->ID_BACDAOTAO= '';
        $this->ID_HEDAOTAO= '';
        $this->MANGANH= '';
        $this->TENNGANH= '';
        $this->ID_KHOA= '';
        $this->GHICHU= '';
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
    public function edit_branch($id){
        $branch = Nganh::where('ID_NGANH',$id)->first();
        $this->ID_BACDAOTAO = $branch->ID_BACDAOTAO;
        $this->ID_HEDAOTAO = $branch->ID_HEDAOTAO;
        $this->MANGANH = $branch->MANGANH;
        $this->TENNGANH = $branch->TENNGANH;
        $this->ID_KHOA = $branch->ID_KHOA;
        $this->GHICHU = $branch->GHICHU;
        $this->ID_NGANH = $branch->ID_NGANH;
        $this->showEditModal = true;
        $this->dispatchBrowserEvent('show-form-edit');
    }
    public function update_branch(){
        $this->validate($this->validator());
        $nganh = Nganh::where('ID_NGANH',$this->ID_NGANH)->first();
        $nganh->ID_BACDAOTAO =$this->ID_BACDAOTAO;
        $nganh->ID_HEDAOTAO =$this->ID_HEDAOTAO;
        $nganh->MANGANH =$this->MANGANH;
        $nganh->TENNGANH =$this->TENNGANH;
        $nganh->ID_KHOA =$this->ID_KHOA;
        $nganh->GHICHU =$this->GHICHU;
        try {
        $nganh->save();
        } catch (ModelNotFoundException $exception) {
            return Toastr::error('Lỗi cập nhật dữ liệu','Thất bại');
        }
        $this->dispatchBrowserEvent('Toastr_message',['message'=>'Cập nhật ngành thành công']);
        $this->dispatchBrowserEvent('hide-form');
    }

    public function add_branch(){
        $this->validate($this->validator());
        $nganh = new Nganh();
        $nganh->ID_BACDAOTAO =$this->ID_BACDAOTAO;
        $nganh->ID_HEDAOTAO =$this->ID_HEDAOTAO;
        $nganh->MANGANH =$this->MANGANH;
        $nganh->TENNGANH =$this->TENNGANH;
        $nganh->ID_KHOA =$this->ID_KHOA;
        $nganh->GHICHU =$this->GHICHU;
        try {
        $nganh->save();
        } catch (ModelNotFoundException $exception) {
            return Toastr::error('Lỗi thêm dữ liệu','Thất bại');
        }
        $this->dispatchBrowserEvent('Toastr_message',['message'=>'Thêm ngành thành công']);
        $this->reset();
        $this->dispatchBrowserEvent('hide-form');
    }
    public function delete_branch($id){
        $nganh = Nganh::where('ID_NGANH',$id)->first();
        $nganh->deleted_at = Carbon::now();
        try {
        $nganh->save();
        } catch (ModelNotFoundException $exception) {
            return Toastr::error('Lỗi xoá dữ liệu','Thất bại');
        }
        $this->dispatchBrowserEvent('Toastr_message',['message'=>'Xoá ngành thành công']);
    }


    public function render()
    {

        if($this->Search){
            $nganhs =Nganh::Where('MANGANH','LIKE','%'.$this->Search.'%')->ORwhere('TENNGANH','LIKE','%'.$this->Search.'%')->whereNULL('deleted_at')->paginate($this->pageSize);
        }else{
            $nganhs =Nganh::whereNULL('deleted_at')->paginate($this->pageSize);
        }

        $khoas =Khoa::whereNull('deleted_at')->get();
        $hedaotaos = Hedaotao::all();
        $bacdaotaos = Bacdaotao::all();
        return view('livewire.teacher.list-branch-component',[
            'hedaotaos'=>$hedaotaos,
            'bacdaotaos' =>$bacdaotaos,
            'khoas' =>$khoas,
            'nganhs' => $nganhs,
        ])->layout('layouts.layout',['title' => 'Trang Quản Lý Ngành CTEC']);
    }
}
