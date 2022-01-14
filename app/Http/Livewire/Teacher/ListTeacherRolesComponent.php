<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Giangvien;
use App\Models\Quyen;
use App\Models\QuyenGv;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;
use Toastr;

class ListTeacherRolesComponent extends Component
{
    public $ID_QUYEN;

    public $ID_GVQUYEN;
    public $showEditModal = FALSE ;
    public $ID_GIANGVIEN = [];
    public $checkall = false;
    private function validator(){
        return [
            'ID_GIANGVIEN'=>'required',
            'ID_QUYEN'=>'required',
         ];
     }
     //clear modal
     public function clearModal(){
        $this->ID_QUYEN= '';
        $this->ID_GIANGVIEN= [];
        $this->showEditModal =false;
        $this->checkall = false;
        $this->resetErrorBag();
        $this->resetValidation();
    }
    public function show_add(){
        $this->ID_GIANGVIEN = [];
        $this->checkall = false;
        $this->clearModal();
        $this->dispatchBrowserEvent('show-form-add');
    }

    public function updated($fields){
        $this->validateOnly($fields,$this->validator());
    }
    Public function edit_roles($id){
        $ROLES = QuyenGv::where('ID_GVQUYEN',$id)->first();
        $this->ID_GIANGVIEN = $ROLES->ID_GIAOVIEN;
        $this->ID_QUYEN = $ROLES->ID_QUYEN;
        $this->ID_GVQUYEN = $ROLES->ID_GVQUYEN;
        $this->showEditModal = true;
        $this->dispatchBrowserEvent('show-form-edit');
    }
    public function update_roles(){
        $this->validate($this->validator());
        $ROLES = QuyenGv::where('ID_GVQUYEN',$this->ID_GVQUYEN)->first();
        $ROLES->ID_QUYEN =$this->ID_QUYEN;
        $ROLES->ID_GIAOVIEN = $this->ID_GIANGVIEN ;
        try {
            $ROLES->save();
        } catch (ModelNotFoundException $exception) {
            return Toastr::error('Lỗi cập nhật dữ liệu','Thất bại');
        }
        $this->dispatchBrowserEvent('Toastr_message',['message'=>'Cập nhật vai trò thành công']);
        $this->dispatchBrowserEvent('hide-form');
    }

    public function add_roles(){
        $this->validate($this->validator());

        foreach($this->ID_GIANGVIEN as $ID_GIANGVIEN){
            $ROLES = new QuyenGv();
            $ROLES->ID_QUYEN =$this->ID_QUYEN;
            $ROLES->ID_GIAOVIEN =$ID_GIANGVIEN;
        try {
        $ROLES->save();
        } catch (ModelNotFoundException $exception) {
            return Toastr::error('Lỗi thêm dữ liệu','Thất bại');
        }
    }
        $this->dispatchBrowserEvent('Toastr_message',['message'=>'Thêm vai trò thành công']);
        $this->reset();
        $this->dispatchBrowserEvent('hide-form');
    }
    public function delete_roles($id){
        try {
            $roles =  QuyenGv::where('ID_GVQUYEN',$id)->delete();
    } catch (ModelNotFoundException $exception) {
        return Toastr::error('Lỗi thêm dữ liệu','Thất bại');
    }
        $this->dispatchBrowserEvent('Toastr_message',['message'=>'Xoá vai trò thành công']);
    }

    public function render()
    {
        $roles_list = QuyenGv::whereNull('deleted_at')->get();
        $quyen = Quyen::whereNull('deleted_at')->get();
        $teachers = Giangvien::whereNull('deleted_at')->get();
        return view('livewire.teacher.list-teacher-roles-component',[
            'roles_list'=>$roles_list,
            'quyen'=>$quyen,
            'teachers'=>$teachers,
        ])->layout('layouts.layout',
        ['title' => 'Trang phân Quyền CTEC']);
    }

    // public function deleteSelected(){
    //     Giangvien::query()
    //     ->whereNull('deleted_at')
    //     ->delete();
    //     $this->checkall = false;
    //     $this->ID_GIANGVIEN = [];
    // }
    public function updatedcheckall($value){
        if($value){
            $this->ID_GIANGVIEN = Giangvien::whereNull('deleted_at')->pluck('ID_GIANGVIEN');
        }else{
            $this->ID_GIANGVIEN = [];
        }
    }
}
