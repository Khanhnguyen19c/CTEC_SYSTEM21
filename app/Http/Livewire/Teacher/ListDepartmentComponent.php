<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Giangvien;
use App\Models\Khoa;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;
use Toastr;
use Livewire\WithPagination;
class ListDepartmentComponent extends Component
{
    use WithPagination;
    public $MAKHOA;
    public $TENKHOA;
    public $TENVIETTAT;
    public $TRUONGKHOA;
    public $GHICHU;

    public $ID_KHOA;
    public $showEditModal = FALSE ;
    public $Search;
    public $pageSize;

    public function mount(){
        $this->pageSize = 12 ;
     }
    private function validator(){
        return [
            'MAKHOA'=>'required',
            'TENKHOA'=>'required',
            'TENVIETTAT'=>'required',
            'TRUONGKHOA'=>'required',
            'GHICHU'=>'max:100',
         ];
     }
     //clear modal
     public function clearModal(){
        $this->MAKHOA= '';
        $this->TENKHOA= '';
        $this->TENVIETTAT= '';
        $this->TRUONGKHOA= '';
        $this->ID_KHOA= '';
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
    Public function edit_department($id){
        $department = Khoa::where('ID_KHOA',$id)->first();
        $this->MAKHOA = $department->MAKHOA;
        $this->TENKHOA = $department->TENKHOA;
        $this->TENVIETTAT = $department->TENVIETTAT;
        $this->TRUONGKHOA = $department->TRUONGKHOA;
        $this->GHICHU = $department->GHICHU;
        $this->ID_KHOA = $department->ID_KHOA;
        $this->showEditModal = true;
        $this->dispatchBrowserEvent('show-form-edit');
    }
    public function update_department(){
        $this->validate($this->validator());
        $department = Khoa::where('ID_KHOA',$this->ID_KHOA)->first();
        $department->MAKHOA =$this->MAKHOA;
        $department->TENKHOA =$this->TENKHOA;
        $department->TENVIETTAT =$this->TENVIETTAT;
        $department->TRUONGKHOA =$this->TRUONGKHOA;
        $department->GHICHU =$this->GHICHU;
        try {
            $department->save();
        } catch (ModelNotFoundException $exception) {
            return Toastr::error('Lỗi cập nhật dữ liệu','Thất bại');
        }
        $this->dispatchBrowserEvent('Toastr_message',['message'=>'Cập nhật khoa thành công']);
        $this->dispatchBrowserEvent('hide-form');
    }

    public function add_department(){
        $this->validate($this->validator());
        $department = new Khoa();
        $department->MAKHOA =$this->MAKHOA;
        $department->TENKHOA =$this->TENKHOA;
        $department->TENVIETTAT =$this->TENVIETTAT;
        $department->TRUONGKHOA =$this->TRUONGKHOA;
        $department->GHICHU =$this->GHICHU;
        try {
        $department->save();
        } catch (ModelNotFoundException $exception) {
            return Toastr::error('Lỗi thêm dữ liệu','Thất bại');
        }
        $this->dispatchBrowserEvent('Toastr_message',['message'=>'Thêm khoa thành công']);
        $this->reset();
        $this->dispatchBrowserEvent('hide-form');
    }
    public function delete_department($id){
        $department = Khoa::where('ID_KHOA',$id)->first();
        $department->deleted_at = Carbon::now();
        try {
        $department->save();
    } catch (ModelNotFoundException $exception) {
        return Toastr::error('Lỗi thêm dữ liệu','Thất bại');
    }
        $this->dispatchBrowserEvent('Toastr_message',['message'=>'Xoá khoa thành công']);
    }

    public function render()
    {

        $teachers = Giangvien::whereNULL('deleted_at')->get();
        if($this->Search){
            $Departments = Khoa::where('MAKHOA','LIKE','%'.$this->Search.'%')
            ->Orwhere('TENKHOA','LIKE','%'.$this->Search.'%')
            ->whereNULL('deleted_at')->paginate($this->pageSize);
        }else{
            $Departments = Khoa::whereNULL('deleted_at')->paginate($this->pageSize);
        }

        return view('livewire.teacher.list-department-component',[
            'Departments' => $Departments,
            'teachers' => $teachers
        ])->layout('layouts.layout',['title' => 'Trang Quản Lý Khoa CTEC']);
    }
}
