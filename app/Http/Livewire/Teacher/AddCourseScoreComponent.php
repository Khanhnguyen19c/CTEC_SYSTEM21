<?php

namespace App\Http\Livewire\Teacher;


use App\Imports\ExcelImportScore;
use App\Models\Giangvien;
use App\Models\Hocphan;
use App\Models\Ketquahocphan;
use App\Models\Lopchuyennganh;
use App\Models\Lophocphan;
use App\Models\Sinhvien;
use App\Models\Sinhvienlophocphan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Toastr;
use Excel;
use Illuminate\Http\Request;
class AddCourseScoreComponent extends Component
{
    public $selectedlophocphan;
    public $ID_SINHVIEN;
    public $HS11;
    public $HS12;
    public $HS13;
    public $HS21;
    public $HS22;
    public $HS23;
    public $TBM;
    public $THILAN1;
    public $THILAN2;
    public $SOTIETVANGLYTHUYET;
    public $SOTIETVANGTHUCHANH;
    public $GHICHU;

    public $student;
    public $classmodule;

    public $selectedhocphan;
    public $teacher;

    public function import_score(Request $request){
            $path = $request->file('file')->getRealPath();
            Excel::import(new ExcelImportScore, $path);
            Toastr::success('Thêm dữ liệu điểm số thành công','Thông báo');
            return Redirect()->back();
    }
    public function mount(){

        $this->teacher = Giangvien::whereHas('user', function($q)
        {
            $q->where('TENDANGNHAP',Auth::user()->code)->WhereNull('deleted_at');

        })->first();
        $this->classmodule = collect();
        $this->student = collect();
    }
    public function clearModal(){
        $this->selectedhocphan='';
        $this->selectedlophocphan = '';
        $this->ID_SINHVIEN = '';
        $this->HS11 = '';
        $this->HS12 = '';
        $this->HS13 = '';
        $this->HS21 = '';
        $this->HS22 = '';
        $this->HS23 = '';
        $this->TBM = '';
        $this->THILAN1 = '';
        $this->THILAN2 = '';
        $this->SOTIETVANGLYTHUYET = '';
        $this->SOTIETVANGTHUCHANH = '';
        $this->GHICHU = '';
        $this->resetErrorBag();
        $this->resetValidation();
    }
    private function validator(){
        return [
            'selectedlophocphan'=> 'required',
            'ID_SINHVIEN'=> 'required',
            'selectedhocphan'=> 'required',
            'THILAN1'=> 'max:5',
            'THILAN2'=> 'max:5',
            'SOTIETVANGLYTHUYET'=> 'max:2',
            'SOTIETVANGTHUCHANH'=> 'max:2',
            'GHICHU'=> 'max:100',
        ];
    }
    public function add_courseScore(){
        $this->validate($this->validator());
        $this->TBM();

        $CourseScore = new Ketquahocphan();
        $CourseScore->ID_LOPHOCPHAN = $this->selectedlophocphan;
        $CourseScore->ID_SINHVIEN = $this->ID_SINHVIEN;
        $CourseScore->ID_HOCPHAN = $this->selectedhocphan;
        $CourseScore->HS11 = $this->HS11;
        $CourseScore->HS12 = $this->HS12;
        $CourseScore->HS13 = $this->HS13;
        $CourseScore->HS21 = $this->HS21;
        $CourseScore->HS22 = $this->HS22;
        $CourseScore->HS23 = $this->HS23;
        $CourseScore->TBM = round($this->TBM,2);
        $CourseScore->THILAN1 = $this->THILAN1;
        $CourseScore->THILAN2 = $this->THILAN2;
        $CourseScore->SOTIETVANGLYTHUYET = $this->SOTIETVANGLYTHUYET;
        $CourseScore->SOTIETVANGTHUCHANH = $this->SOTIETVANGTHUCHANH;
        $CourseScore->GHICHU = $this->GHICHU;
        if($this->TBM < 5 ){
            $CourseScore->CAMTHI = 1;
        }else{
            $CourseScore->CAMTHI = 0;
        }
        if($this->THILAN2){
            $CourseScore->TRUNGBINH10 = round(($this->THILAN2 * 0.6) + ($this->TBM *0.4) ,2)  ;

        }elseif($this->THILAN1){
            $CourseScore->TRUNGBINH10 = round(($this->THILAN1 * 0.6) + ($this->TBM *0.4) ,2)  ;
        }else{
            $CourseScore->TRUNGBINH10 = NULL;
        }
        if($CourseScore->TRUNGBINH10 < 4 ){
            $CourseScore->DAT = 0 ;
        }else{
            $CourseScore->DAT = 1 ;
        }
        if($CourseScore->TRUNGBINH10 >= 9.1){
            $CourseScore->TRUNGBINH4 = 4;
        }
        elseif($CourseScore->TRUNGBINH10 >= 8.5){
            $CourseScore->TRUNGBINH4 = 3.7;
        }
        elseif($CourseScore->TRUNGBINH10 >= 7.8){
            $CourseScore->TRUNGBINH4 = 3.3;
        }
        elseif($CourseScore->TRUNGBINH10 >= 7.0){
            $CourseScore->TRUNGBINH4 = 3.0;
        }
        elseif($CourseScore->TRUNGBINH10 >= 6.5){
            $CourseScore->TRUNGBINH4 = 2.7;
        }
        elseif($CourseScore->TRUNGBINH10 >= 6.0){
            $CourseScore->TRUNGBINH4 = 2.3;
        }
        elseif($CourseScore->TRUNGBINH10 >= 5.5){
            $CourseScore->TRUNGBINH4 = 2.0;
        }
        elseif($CourseScore->TRUNGBINH10 >= 5.0){
            $CourseScore->TRUNGBINH4 = 1.7;
        }  elseif($CourseScore->TRUNGBINH10 >= 4.5){
            $CourseScore->TRUNGBINH4 = 1.3;
        }
        elseif($CourseScore->TRUNGBINH10 >= 4.0){
            $CourseScore->TRUNGBINH4 = 1.0;
        }else{
            $CourseScore->TRUNGBINH4 = 0;
        }
        try{
            $checkScore = Ketquahocphan::where('ID_SINHVIEN',$this->ID_SINHVIEN)->WHERE('ID_LOPHOCPHAN',$this->selectedlophocphan)->first();
            if($checkScore){
                Toastr::warning('Sinh viên này đã có điểm rồi!!!','Thông Báo');
                return redirect()->route('coursescore_edit',['ID_SINHVIEN'=>$this->ID_SINHVIEN,'ID_LOPHOCPHAN'=>$this->selectedlophocphan]);
            }
            $CourseScore->save();
            $this->clearModal();
        }catch(ModelNotFoundException){
            return Toastr::error('Lỗi thêm mới','Thất bại');
        }
        $this->dispatchBrowserEvent('Toastr_message', ['message' => 'Thêm điểm số thành công']);
    }
    public function render()
    {
        $module = Lophocphan::where('ID_GIAOVIEN',$this->teacher->ID_GIANGVIEN)->WhereNull('deleted_at')->GET();
        return view('livewire.teacher.add-course-score-component',[
            'module' => $module
        ])->layout('layouts.layout',['title' => 'Trang Thêm Điểm Học Phần CTEC']);
    }

    public function updatedselectedlophocphan($ID_LOP){
           if($ID_LOP){
            $this->student = Sinhvienlophocphan::where('ID_LOPHOCPHAN',$ID_LOP)->WHERENULL('deleted_at')->get();
           }else{
               $this->student = [];
           }

    }
    public function updatedselectedhocphan($id){
        $this->classmodule = Lophocphan::where('ID_HOCPHAN',$id)->where('ID_GIAOVIEN',$this->teacher->ID_GIANGVIEN)->WHERENULL('deleted_at')->get();
    }
    private function TBM(){
        $heso = 0;
        if($this->HS11){
            $heso = 1;
        }else{
            $this->HS11 = NULL ;
        }
        if($this->HS12){
            $heso = $heso + 1 ;
        }else{
            $this->HS12 = NULL ;
        }
        if($this->HS13){
            $heso = $heso + 1 ;
        }else{
            $this->HS13 = NULL ;
        }
        if($this->HS21){
            $HS21 = $this->HS21 * 2;
            $heso = $heso + 2;
        }else{
            $this->HS21 = NULL ;
            $HS21 =null;
        }
        if($this->HS22){
            $HS22 = $this->HS22 * 2;
            $heso = $heso + 2;
        }else{
            $this->HS22 = NULL ;
            $HS22 = null;
        }
        if($this->HS23){
            $HS23 = $this->HS23 * 2;
            $heso = $heso + 2;
        }else{
            $this->HS23 = NULL ;
            $HS23 = null;
        }

        $this->TBM = ($this->HS11 + $this->HS12 + $this->HS13 + $HS21 + $HS22 + $HS23) / $heso;

    }
}
