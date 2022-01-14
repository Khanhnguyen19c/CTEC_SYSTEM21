<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Bacdaotao;
use App\Models\Giangvien;
use App\Models\Hedaotao;
use App\Models\Hocphan;
use App\Models\Khoa;
use App\Models\Lopchuyennganh;
use App\Models\Lophocphan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Toastr;
use Livewire\WithPagination;
class ListClassModuleComponent extends Component
{
    use WithPagination;
    public $pageSize;
    public $ID_HOCPHAN;
    public $HOCKY;
    public $NIENKHOA;
    public $MALOPHOCPHAN;
    public $TENLOPHOCPHAN;
    public $ID_BACDAOTAO;
    public $ID_HEDAOTAO;
    public $GHICHU;
    public $ID_LOPHOCPHAN;
    public $showEditModal;

    public $khoa;
    public $giangvien;

    public $selecetedgiangvien;
    public $selecetedkhoa;
    public $Search;

    public $KHOA_ID;

    private function validator(){
        return[
            'ID_HOCPHAN'=>'required',
            'selecetedgiangvien'=>'required',
            'HOCKY'=>'required',
            'NIENKHOA'=>'required',
            'MALOPHOCPHAN'=>'required',
            'TENLOPHOCPHAN'=>'required',
            'ID_BACDAOTAO'=>'required',
            'ID_HEDAOTAO'=>'required',
            'selecetedkhoa'=>'required',
            'GHICHU'=>'max:100',
        ];
    }
   //clear modal
    public function clearModal(){
        $this->ID_HOCPHAN ='';
        $this->selecetedgiangvien ='';
        $this->selecetedkhoa ='';
        $this->HOCKY ='';
        $this->NIENKHOA ='';
        $this->MALOPHOCPHAN ='';
        $this->TENLOPHOCPHAN ='';
        $this->ID_BACDAOTAO ='';
        $this->ID_HEDAOTAO ='';
        $this->GHICHU ='';
        $this->ID_LOPHOCPHAN = '';
        $this->showEditModal =false;
        $this->resetErrorBag();
        $this->resetValidation();
    }
    public function show_add(){
            $this->clearModal();
            $this->dispatchBrowserEvent('show-form-add');
    }

    public function add_classmodule(){
        $this->validate($this->validator());
        $classmodule = new Lophocphan();
        $classmodule->ID_HOCPHAN = $this->ID_HOCPHAN;
        $classmodule->ID_GIAOVIEN = $this->selecetedgiangvien ;
        $classmodule->HOCKY = $this->HOCKY;
        $classmodule->NIENKHOA = $this->NIENKHOA ;
        $classmodule->MALOPHOCPHAN =$this->MALOPHOCPHAN ;
        $classmodule->TENLOPHOCPHAN = $this->TENLOPHOCPHAN;
        $classmodule->ID_BACDAOTAO =  $this->ID_BACDAOTAO ;
        $classmodule->ID_HEDAOTAO = $this->ID_HEDAOTAO;
        $classmodule->ID_KHOA = $this->selecetedkhoa;
        $classmodule->GHICHU =  $this->GHICHU;
       try{
           $classmodule->save();
       }catch(ModelNotFoundException){
        return Toastr::error('Lỗi thêm dữ liệu','Thất bại');
       }
        $this->dispatchBrowserEvent('Toastr_message',['message'=>'Thêm lớp học phần thành công']);
        $this->dispatchBrowserEvent('hide-form');
    }

    public function edit_classmodule($id){
        $classmodule = Lophocphan::where('ID_LOPHOCPHAN',$id)->first();
        $this->ID_HOCPHAN =  $classmodule->ID_HOCPHAN;
        $this->selecetedgiangvien =  $classmodule-> ID_GIAOVIEN;
        $this->HOCKY = $classmodule->HOCKY;
        $this->NIENKHOA =   $classmodule->NIENKHOA;
        $this->MALOPHOCPHAN = $classmodule->MALOPHOCPHAN  ;
        $this->TENLOPHOCPHAN =  $classmodule->TENLOPHOCPHAN ;
        $this->ID_BACDAOTAO =  $classmodule->ID_BACDAOTAO ;
        $this->ID_HEDAOTAO =  $classmodule->ID_HEDAOTAO ;
        $this->selecetedkhoa =  $classmodule->ID_KHOA;
        $this->GHICHU =  $classmodule->GHICHU ;
        $this->ID_LOPHOCPHAN = $classmodule->ID_LOPHOCPHAN;
        $this->showEditModal =true;
        $this->dispatchBrowserEvent('show-form-edit');

    }

    public function update_classmodule(){
        $classmodule = Lophocphan::where('ID_LOPHOCPHAN',$this->ID_LOPHOCPHAN)->first();
        $classmodule->ID_HOCPHAN = $this->ID_HOCPHAN;
        $classmodule->ID_GIAOVIEN = $this-> selecetedgiangvien ;
        $classmodule->HOCKY = $this->HOCKY;
        $classmodule->NIENKHOA = $this->NIENKHOA ;
        $classmodule->MALOPHOCPHAN =$this->MALOPHOCPHAN ;
        $classmodule->TENLOPHOCPHAN = $this->TENLOPHOCPHAN;
        $classmodule->ID_BACDAOTAO =  $this->ID_BACDAOTAO ;
        $classmodule->ID_HEDAOTAO = $this->ID_HEDAOTAO;
        $classmodule->ID_KHOA = $this->selecetedkhoa;
        $classmodule->GHICHU =  $this->GHICHU;
        try{
            $classmodule->save();
        }catch(ModelNotFoundException){
         return Toastr::error('Lỗi cập nhật dữ liệu','Thất bại');
        }
         $this->dispatchBrowserEvent('Toastr_message',['message'=>'Cập nhật lớp học phần thành công']);
         $this->dispatchBrowserEvent('hide-form');
    }

    public function delete_classmodule($id){
        $classmodule = Lophocphan::where('ID_LOPHOCPHAN',$id)->first();
        $classmodule->deleted_at = Carbon::now();
        try{
            $classmodule->save();
        }catch(ModelNotFoundException){
         return Toastr::error('Lỗi xoá dữ liệu','Thất bại');
        }

    }
    public function mount(){
        $this->pageSize = 12 ;
        $this->khoa = Khoa::all();
        $this->giangvien = Giangvien::whereNull('deleted_at')->get();
    }

    public function render()
    {

        $bacdaotao = Bacdaotao::all();
        $hedaotao = Hedaotao::all();
        $module = Hocphan::whereNull('deleted_at')->get();
        $class = Lopchuyennganh::whereNull('deleted_at')->get();
        $years = Carbon::now()->format('Y');

            if($this->Search){
                if($this->KHOA_ID){
                    $classModules = Lophocphan::query()
                    ->where('lophocphans.ID_KHOA',$this->KHOA_ID)
                    ->where('TENLOPHOCPHAN','LIKE','%'.$this->Search.'%')
                    ->where(
                        function($query) use ($years){
                            $query->where('NIENKHOA', 'LIKE', '%'.$years.'%' )
                            ->ORwhere('NIENKHOA', 'LIKE', '%'.($years - 1).'%' );
                    })
                    ->Orwhere('MALOPHOCPHAN','LIKE','%'.$this->Search.'%')
                    ->whereNull('lophocphans.deleted_at')->paginate($this->pageSize);
                }else{
                    $classModules = Lophocphan::query()
                    ->where('TENLOPHOCPHAN','LIKE','%'.$this->Search.'%')
                    ->where(
                        function($query) use ($years){
                            $query->where('NIENKHOA', 'LIKE', '%'.$years.'%' )
                                ->ORwhere('NIENKHOA', 'LIKE', '%'.($years - 1).'%' );
                    })
                    ->Orwhere('MALOPHOCPHAN','LIKE','%'.$this->Search.'%')
                    ->whereNull('lophocphans.deleted_at')->paginate($this->pageSize);
                }
            }else{
                if($this->KHOA_ID){
                    $classModules = Lophocphan::query()
                    ->where('lophocphans.ID_KHOA',$this->KHOA_ID)
                    ->where(
                        function($query) use ($years){
                            $query->where('NIENKHOA', 'LIKE', '%'.$years.'%' )
                                ->ORwhere('NIENKHOA', 'LIKE', '%'.($years - 1).'%' );
                    })
                    ->whereNull('lophocphans.deleted_at')->paginate($this->pageSize);
                }else{
                    $classModules = Lophocphan::query()
                    ->where(
                        function($query) use ($years){
                            $query->where('NIENKHOA', 'LIKE', '%'.$years.'%' )
                                ->ORwhere('NIENKHOA', 'LIKE', '%'.($years - 1).'%' );
                    })
                    ->whereNull('deleted_at')->paginate($this->pageSize);
                }
            }

        $khoa = Khoa::whereNULL('deleted_at')->get();
        return view('livewire.teacher.list-class-module-component',[
            'classModules' => $classModules,
            'bacdaotaos' => $bacdaotao,
            'hedaotaos' => $hedaotao,
            'module' => $module,
            'class' => $class,
            'khoa'=>$khoa,
        ])->layout('layouts.layout',['title' => 'Trang Quản Lý Lớp Học Phần CTEC']);
    }

    public function updatedselecetedkhoa($id_khoa)
    {
        $this->giangvien = Giangvien::where('ID_KHOA', $id_khoa)->whereNULL('deleted_at')->get();
    }



}
