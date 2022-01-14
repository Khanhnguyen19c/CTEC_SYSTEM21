<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Giangvien;
use App\Models\Quyen;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;
use Toastr;
class ListRolesComponent extends Component
{
    public $MAQUYEN;
    public $DIENGIAI;
    public $GIANGVIEN;
    public $GHICHU;

    public $ID_QUYEN;
    public $showEditModal = FALSE ;

    private function validator(){
        return [
            'MAQUYEN'=>'required',
            'DIENGIAI'=>'required',
            'GIANGVIEN'=>'required',
            'GHICHU'=>'max:100',
         ];
     }
     //clear modal
     public function clearModal(){
        $this->MAQUYEN= '';
        $this->DIENGIAI= '';
        $this->GIANGVIEN= '';
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
    Public function edit_roles($id){
        $ROLES = Quyen::where('ID_QUYEN',$id)->first();
        $this->MAQUYEN = $ROLES->MA_QUYEN;
        $this->DIENGIAI = $ROLES->DIENGIAI;
        $this->GIANGVIEN = $ROLES->ID_GIAOVIENQUANLY;
        $this->GHICHU = $ROLES->GHICHU;
        $this->ID_QUYEN = $ROLES->ID_QUYEN;
        $this->showEditModal = true;
        $this->dispatchBrowserEvent('show-form-edit');
    }
    public function update_roles(){
        $this->validate($this->validator());
        $ROLES = Quyen::where('ID_QUYEN',$this->ID_QUYEN)->first();
        $ROLES->MA_QUYEN =$this->MAQUYEN;
        $ROLES->DIENGIAI =$this->DIENGIAI;
        $ROLES->ID_GIAOVIENQUANLY =$this->GIANGVIEN;
        $ROLES->GHICHU =$this->GHICHU;
        try {
            $ROLES->save();
        } catch (ModelNotFoundException $exception) {
            return Toastr::error('Lỗi cập nhật dữ liệu','Thất bại');
        }
        $this->dispatchBrowserEvent('Toastr_message',['message'=>'Cập nhật quyền thành công']);
        $this->dispatchBrowserEvent('hide-form');
    }

    public function add_roles(){
        $this->validate($this->validator());
        $ROLES = new Quyen();
        $ROLES->MA_QUYEN =$this->MAQUYEN;
        $ROLES->DIENGIAI =$this->DIENGIAI;
        $ROLES->ID_GIAOVIENQUANLY =$this->GIANGVIEN;
        $ROLES->GHICHU =$this->GHICHU;
        try {
        $ROLES->save();
        } catch (ModelNotFoundException $exception) {
            return Toastr::error('Lỗi thêm dữ liệu','Thất bại');
        }
        $this->dispatchBrowserEvent('Toastr_message',['message'=>'Thêm quyền thành công']);
        $this->reset();
        $this->dispatchBrowserEvent('hide-form');
    }
    public function delete_roles($id){
        $roles = Quyen::where('ID_QUYEN',$id)->first();
        $roles->deleted_at = Carbon::now();
        try {
        $roles->save();
    } catch (ModelNotFoundException $exception) {
        return Toastr::error('Lỗi thêm dữ liệu','Thất bại');
    }
        $this->dispatchBrowserEvent('Toastr_message',['message'=>'Xoá quyền thành công']);
    }
    public function render()
    {
        $roles = Quyen::whereNull('deleted_at')->get();
        $teachers = Giangvien::whereNull('deleted_at')->get();
        return view('livewire.teacher.list-roles-component',[
            'roles' => $roles,
            'teachers'=>$teachers,
        ])->layout('layouts.layout',['title' => 'Trang Quản Lý Quyền CTEC']);
    }
}
