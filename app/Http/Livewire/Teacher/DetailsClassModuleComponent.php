<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Ketquahocphan;
use App\Models\Khoa;
use App\Models\Lopchuyennganh;
use App\Models\Lophocphan;
use App\Models\Sinhvien;
use App\Models\Sinhvienlophocphan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;
use Livewire\WithPagination;
class DetailsClassModuleComponent extends Component
{
    use WithPagination;
    public $id_class;
    public $id_studentclass;
    public $checkall =false;
    public $selectedlopchuyennganh =[];
    public $ID_SINHVIEN =[];
    public $ID_LOP;
    public $ID_LOPHOCPHAN;
    public $ID_LOPCHUYENNGANH;
    public $sinhvien;

    public $search;
    public $pageSize;

    public $showEditModal = False;
    //clear modal
    public function clearModal()
    {
        $this->showEditModal = false;
        $this->checkall = false;
        $this->selectedlopchuyennganh = '';
        $this->ID_LOP = '';
        $this->ID_LOPHOCPHAN = '';
        $this->ID_LOPCHUYENNGANH = '';
        $this->ID_SINHVIEN =[];
        $this->sinhvien =[];
        $this->resetErrorBag();
        $this->resetValidation();
    }
    public function mount($id){
        $this->pageSize=12;
        $this->id_class = $id;
        $this->sinhvien = collect();
    }

    public function show_studentclass(){
        $this->checkall = false;
        $this->clearModal();
        $this->dispatchBrowserEvent('show-form-addclass');
        $this->ID_LOPHOCPHAN =  $this->id_class;
    }

    // public function edit_classModule($id){
    //     $student = Sinhvienlophocphan::find($id);
    //     $this->ID_SINHVIEN= $student->ID_SINHVIEN;
    //     $this->ID_LOPHOCPHAN=$student->ID_LOPHOCPHAN;
    //     $this->ID_LOPCHUYENNGANH=$student->ID_LOPCHUYENNGANH;
    //     $this->id_studentclass = $student->id;
    //     $this->showEditModal = true;
    //     $this->dispatchBrowserEvent('show-form-edit');

    // }
    // public function update_classModule(){
    //     $student = Sinhvienlophocphan::find($this->id_studentclass);
    //     $student->ID_SINHVIEN = $this->ID_SINHVIEN;
    //     $student->ID_LOPHOCPHAN = $this->ID_LOPHOCPHAN;
    //     $student->ID_LOPCHUYENNGANH = $this->ID_LOPCHUYENNGANH;

    //     try{
    //         $student->save();
    //     }catch(ModelNotFoundException){
    //         return  $this->dispatchBrowserEvent('Toastr_message',['message'=>'Cập nhật sinh viên lớp học phần thất bại']);
    //     }
    // }
    public function add_studentclass(){
        $count = 0;
        foreach($this->ID_SINHVIEN as $SINHVIEN){
            $count++;
            $student = new Sinhvienlophocphan();
            $student->ID_LOPCHUYENNGANH = $this->ID_LOPCHUYENNGANH;
            $student->ID_LOPHOCPHAN = $this->ID_LOPHOCPHAN;
            $student->ID_SINHVIEN = $SINHVIEN;

            try{
                $student->save();
            }catch(ModelNotFoundException){
              return  $this->dispatchBrowserEvent('Toastr_message',['message'=>'Thêm sinh viên lớp học phần thất bại']);
            }
        }
        $lophocphan = Lophocphan::where('ID_LOPHOCPHAN',$this->ID_LOPHOCPHAN)->first();
        $student = Sinhvienlophocphan::where('ID_LOPHOCPHAN',$this->ID_LOPHOCPHAN)->whereNull('deleted_at');
        $lophocphan->SISO=  $student->count();
        $lophocphan->save();

        $this->dispatchBrowserEvent('Toastr_message',['message'=>'Cập nhật lớp học phần thành công']);
        $this->dispatchBrowserEvent('hide-form');
    }
    public function updatedselectedlopchuyennganh($idlop){

        $this->sinhvien = Sinhvien::where('ID_LOPCHUYENNGANH',$idlop)->whereNull('deleted_at')->get();

        $this->ID_LOPCHUYENNGANH = $idlop;
        $this->checkall =false;
        // $this->ID_SINHVIEN = [];
    }
    public function updatedcheckall($value){
        if($value){
            $this->ID_SINHVIEN = Sinhvien::WHERE('ID_LOPCHUYENNGANH',$this->ID_LOPCHUYENNGANH)->whereNULL('deleted_at')->pluck('ID_SINHVIEN');
        }else{
            $this->ID_SINHVIEN = [];
        }
    }
    public function delete_student($id){
        $student = Sinhvienlophocphan::find($id);
        $student->deleted_at = Carbon::now();
        try{
            $student->save();
            $lophocphan = Lophocphan::where('ID_LOPHOCPHAN',$student->ID_LOPHOCPHAN)->FIRST();
            $lophocphan->SISO=  Sinhvienlophocphan::where('ID_LOPHOCPHAN',$this->ID_LOPHOCPHAN)->whereNULL('deleted_at')->count();
            $lophocphan->save();
        }catch(ModelNotFoundException){
            return  $this->dispatchBrowserEvent('Toastr_message',['message'=>'Xoá sinh viên lớp học phần thất bại']);
        }

        $this->dispatchBrowserEvent('Toastr_message',['message'=>'Xoá Sinh viên khỏi lớp học phần thành công!']);
    }
    public function render()
    {

        if($this->search){
            $students = Sinhvienlophocphan::whereHas('sinhvien',function($q)
            {
                $q->where('TEN','LIKE','%'.$this->search.'%')->Orwhere('HODEM','LIKE','%'.$this->search.'%')->Orwhere('MASV','LIKE','%'.$this->search.'%');
            })
            ->where('ID_LOPHOCPHAN',$this->id_class)
            ->whereNull('deleted_at')->paginate($this->pageSize);
        }else{
            $students = Sinhvienlophocphan::where('ID_LOPHOCPHAN',$this->id_class)
            ->whereNull('deleted_at')->paginate($this->pageSize);
        }
        $class =Lopchuyennganh::whereNull('deleted_at')->get();
        $tile = Lophocphan::where('ID_LOPHOCPHAN',$this->id_class)->whereNull('deleted_at')->first();
        return view('livewire.teacher.details-class-module-component',[
            'students' => $students,
            'tile' => $tile,
            'class'=>$class
        ])->layout('layouts.layout',['title' => 'Trang Thêm Sinh Viên Lớp Học Phần CTEC']);
    }
}
