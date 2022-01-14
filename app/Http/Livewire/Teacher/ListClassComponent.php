<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Bacdaotao;
use App\Models\Chuyennganh;
use App\Models\Giangvien;
use App\Models\Hedaotao;
use App\Models\Lopchuyennganh;
use App\Models\Nganh;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;
use Toastr;
use Livewire\WithPagination;
class ListClassComponent extends Component
{
    use WithPagination;
    public $MALOPCHUYENNGANH;
    public $GVCN;
    public $NAMNHAPHOC;
    public $SISOLOP;
    public $CS;
    public $ID_BACDAOTAO;
    public $ID_HEDAOTAO;
    public $GHICHU;
    public $ID_LOPCHUYENNGANH;

    public $chuyennganh;
    public $selectedchuyennganh;
    public $giaovien;
    public $showEditModal = False;
    public $pageSize;
    public $search;

    public $NGANH_ID;
  
    private function validator()
    {
        return [
            'MALOPCHUYENNGANH' => 'required',
            'GVCN' => 'required',
            'SISOLOP' => 'required',
            'CS' => 'required',
            'ID_BACDAOTAO' => 'required',
            'ID_HEDAOTAO' => 'required',
            'GHICHU' => 'Max:100',
            'selectedchuyennganh' => 'required',
        ];
    }

    public function mount()
    {
        $this->pageSize = 12;
        $this->chuyennganh = Chuyennganh::whereNull('deleted_at')->get();
        $this->giaovien =  Giangvien::whereNull('deleted_at')->get();
    }

    //clear modal
    public function clearModal()
    {
        $this->MALOPCHUYENNGANH = '';
        $this->GVCN = '';
        $this->NAMNHAPHOC = '';
        $this->SISOLOP = '';
        $this->CS = '';
        $this->ID_BACDAOTAO = '';
        $this->ID_HEDAOTAO = '';
        $this->GHICHU = '';
        $this->selectedchuyennganh = '';
        $this->ID_LOPCHUYENNGANH = '';
        $this->showEditModal = false;
        $this->resetErrorBag();
        $this->resetValidation();
    }
    //SHOW FORM ADD
    public function showForm()
    {
        $this->showEditModal = false;
        $this->clearModal();
        $this->dispatchBrowserEvent('show-form-add');
    }

    //SHOW FORM EDIT
    public function edit_class($id)
    {
        $lopchuyennganh = Lopchuyennganh::where('ID_LOPCHUYENNGANH', $id)->first();
        $this->MALOPCHUYENNGANH = $lopchuyennganh->MALOPCHUYENNGANH;
        $this->GVCN = $lopchuyennganh->GVCN;
        $this->NAMNHAPHOC = $lopchuyennganh->NAMNHAPHOC;
        $this->SISOLOP = $lopchuyennganh->SISO;
        $this->CS = $lopchuyennganh->CS;
        $this->ID_BACDAOTAO = $lopchuyennganh->ID_BACDAOTAO;
        $this->ID_HEDAOTAO = $lopchuyennganh->ID_HEDAOTAO;
        $this->GHICHU = $lopchuyennganh->GHICHU;
        $this->selectedchuyennganh = $lopchuyennganh->ID_CHUYENNGANH;
        $this->ID_LOPCHUYENNGANH = $lopchuyennganh->ID_LOPCHUYENNGANH;
        $this->showEditModal = true;
        $this->dispatchBrowserEvent('show-form-edit');
    }
    //validate
    public function updated($fields)
    {
        $this->validateOnly($fields, $this->validator());
    }
    //UPDATE FORM EDIT
    public function update_class()
    {
        $this->validate($this->validator());
        $lopchuyennganh = Lopchuyennganh::where('ID_LOPCHUYENNGANH', $this->ID_LOPCHUYENNGANH)->first();
        $lopchuyennganh->MALOPCHUYENNGANH = $this->MALOPCHUYENNGANH;
        $lopchuyennganh->GVCN = $this->GVCN;
        $lopchuyennganh->NAMNHAPHOC = $this->NAMNHAPHOC;
        $lopchuyennganh->SISO = $this->SISOLOP;
        $lopchuyennganh->CS = $this->CS;
        $lopchuyennganh->ID_BACDAOTAO = $this->ID_BACDAOTAO;
        $lopchuyennganh->ID_HEDAOTAO =  $this->ID_HEDAOTAO;
        $lopchuyennganh->GHICHU = $this->GHICHU;
        $lopchuyennganh->ID_CHUYENNGANH =  $this->selectedchuyennganh;
        try {
            $lopchuyennganh->save();
        } catch (ModelNotFoundException $exception) {
            return Toastr::error('Lỗi cập nhật dữ liệu', 'Thất bại');
        }
        $this->dispatchBrowserEvent('Toastr_message', ['message' => 'Cập nhật lớp chuyên ngành thành công!']);
        $this->dispatchBrowserEvent('hide-form');
    }
    //ADD CLASS
    public function add_class()
    {
        $this->validate($this->validator());
        $lopchuyennganh = new Lopchuyennganh();
        $lopchuyennganh->MALOPCHUYENNGANH = $this->MALOPCHUYENNGANH;
        $lopchuyennganh->GVCN = $this->GVCN;
        $lopchuyennganh->NAMNHAPHOC = $this->NAMNHAPHOC;
        $lopchuyennganh->SISO = $this->SISOLOP;
        $lopchuyennganh->CS = $this->CS;
        $lopchuyennganh->ID_BACDAOTAO = $this->ID_BACDAOTAO;
        $lopchuyennganh->ID_HEDAOTAO =  $this->ID_HEDAOTAO;
        $lopchuyennganh->GHICHU = $this->GHICHU;
        $lopchuyennganh->ID_CHUYENNGANH =  $this->selectedchuyennganh;
        try {
            $lopchuyennganh->save();
        } catch (ModelNotFoundException $exception) {
            return Toastr::error('Lỗi thêm dữ liệu', 'Thất bại');
        }
        $this->clearModal();
        $this->dispatchBrowserEvent('hide-form');
        $this->dispatchBrowserEvent('Toastr_message', ['message' => 'Thêm dữ liệu lớp học thành công']);
    }
    //DELETE CLASS
    public function delete_class($id)
    {
        $lopchuyennganh = Lopchuyennganh::where('ID_LOPCHUYENNGANH', $id)->first();
        $lopchuyennganh->deleted_at = Carbon::now();
        try {
            $lopchuyennganh->save();
        } catch (ModelNotFoundException $exception) {
            return Toastr::error('Xoá gặp lỗi', 'Thất bại');
        }
        $this->dispatchBrowserEvent('Toastr_message', ['message' => 'Xoá lớp chuyên ngành thành công!']);
        return redirect()->back();
    }

    public function render()
    {
        if ($this->search) {
            if($this->NGANH_ID){
                $class = Lopchuyennganh::where('ID_CHUYENNGANH',$this->NGANH_ID)
                ->where('MALOPCHUYENNGANH', 'LIKE', '%' . $this->search . '%')->whereNull('deleted_at')->paginate($this->pageSize);
            }else{
                $class = Lopchuyennganh::where('MALOPCHUYENNGANH', 'LIKE', '%' . $this->search . '%')->whereNull('deleted_at')->paginate($this->pageSize);
            }
        } else {
            if($this->NGANH_ID){
                $class = Lopchuyennganh::where('ID_CHUYENNGANH',$this->NGANH_ID)->whereNull('deleted_at')->paginate($this->pageSize);
            }else{
                $class = Lopchuyennganh::whereNull('deleted_at')->whereNull('deleted_at')->paginate($this->pageSize);
            }

        }
        $bacdaotao = Bacdaotao::all();
        $hedaotao = Hedaotao::all();
        $chuyennganh = Chuyennganh::whereNULL('deleted_at')->get();
        return view('livewire.teacher.list-class-component', [
            'class' => $class,
            'bacdaotao' => $bacdaotao,
            'hedaotao' => $hedaotao,
            'chuyennganh'=>$chuyennganh,
        ])->layout('layouts.layout',['title' => 'Trang Quản Lý Lớp Chuyên Ngành CTEC']);
    }

    public function updatedselectedchuyennganh($ID_CHUYENNGANH)
    {
        $CHUYENNGANH = Chuyennganh::where('ID_CHUYENNGANH', $ID_CHUYENNGANH)->whereNull('deleted_at')->first();
        if ($CHUYENNGANH) {
            $ID_NGANH = $CHUYENNGANH->ID_NGANH;
            $NGANH = Nganh::where('ID_NGANH', $ID_NGANH)->whereNull('deleted_at')->first();
            $KHOA_ID = $NGANH->ID_KHOA;
            $this->giaovien = Giangvien::WHERE('ID_KHOA', $KHOA_ID)->whereNull('deleted_at')->get();
        }
    }
}
