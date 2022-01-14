<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Giangvien;
use App\Models\Hocphan;
use App\Models\Ketquahocphan;
use App\Models\Lophocphan;
use App\Models\Sinhvien;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Toastr;
class EditCourseScoreComponent extends Component
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

    public $teacher;
    public $ID_KETQUAHOCPHAN;
    public $selectedhocphan;
    public function mount($ID_SINHVIEN,$ID_LOPHOCPHAN){

        $CourseScore = Ketquahocphan::where('ID_SINHVIEN',$ID_SINHVIEN)->where('ID_LOPHOCPHAN',$ID_LOPHOCPHAN)->whereNull('deleted_at')->first();
        $this->selectedlophocphan = $CourseScore->ID_LOPHOCPHAN;
        $this->ID_SINHVIEN = $CourseScore->ID_SINHVIEN;
        $this->ID_HOCPHAN = $CourseScore->ID_HOCPHAN;
        $this->HS11 = $CourseScore->HS11;
        $this->HS12 = $CourseScore->HS12;
        $this->HS13 = $CourseScore->HS13;
        $this->HS21 = $CourseScore->HS21;
        $this->HS22 = $CourseScore->HS22;
        $this->HS23 = $CourseScore->HS23;
        $this->THILAN1 = $CourseScore->THILAN1;
        $this->THILAN2 = $CourseScore->THILAN2;
        $this->SOTIETVANGLYTHUYET = $CourseScore->SOTIETVANGLYTHUYET;
        $this->SOTIETVANGTHUCHANH = $CourseScore->SOTIETVANGTHUCHANH;
        $this->GHICHU = $CourseScore->GHICHU;
        $this->ID_KETQUAHOCPHAN = $CourseScore->ID_KETQUAHOCPHAN;

        $this->teacher = Giangvien::whereHas('user', function($q)
        {
            $q->where('TENDANGNHAP',Auth::user()->code)->WhereNull('deleted_at');

        })->first();
        $this->classmodule = Lophocphan::where('ID_GIAOVIEN',$this->teacher->ID_GIANGVIEN)->whereNull('deleted_at')->get();
        $this->student = Sinhvien::wherenull('deleted_at')->get();
    }
    private function validator(){
        return [
            'selectedlophocphan'=> 'required',
            'ID_SINHVIEN'=> 'required',
            'ID_HOCPHAN'=> 'required',
            'THILAN1'=> 'max:5',
            'THILAN2'=> 'max:5',
            'SOTIETVANGLYTHUYET'=> 'max:2',
            'SOTIETVANGTHUCHANH'=> 'max:2',
            'GHICHU'=> 'max:100',
        ];
    }
    public function update_courseScore(){
        $this->validate($this->validator());
        $this->TBM();

        $CourseScore = Ketquahocphan::where('ID_KETQUAHOCPHAN',$this->ID_KETQUAHOCPHAN)->whereNull('deleted_at')->first();
        $CourseScore->ID_LOPHOCPHAN = $this->selectedlophocphan;
        $CourseScore->ID_SINHVIEN = $this->ID_SINHVIEN;
        $CourseScore->ID_HOCPHAN = $this->ID_HOCPHAN;
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
             $CourseScore->save();
        }catch(ModelNotFoundException){
            return Toastr::error('Lỗi cập nhật','Thất bại');
        }
        Toastr::success('Cập nhật điểm số thành công','Thông báo');
        return Redirect()->route('coursescore_list');
    }

    public function updatedselectedlophocphan($ID_LOP){
        $lophocphan = Lophocphan::where('ID_LOPHOCPHAN',$ID_LOP)->WHERENULL('deleted_at')->first();
        if($lophocphan){
            $ID_CHUYENNGANH= $lophocphan->ID_LOPCHUYENNGANH;
            $this->student = Sinhvien::where('ID_LOPCHUYENNGANH',$ID_CHUYENNGANH)->WHERENULL('deleted_at')->get();
        }
    }

    public function render()
    {
        $module = Lophocphan::where('ID_GIAOVIEN',$this->teacher->ID_GIANGVIEN)->WhereNull('deleted_at')->GET();
        return view('livewire.teacher.edit-course-score-component',[
            'module' => $module
        ])->layout('layouts.layout',['title' => 'Trang Cập Nhật Điêm Số Học Phần CTEC']);
    }
    private function TBM(){
        $hocphan = Hocphan::Where('ID_HOCPHAN',$this->ID_HOCPHAN)->WHERENULL('deleted_at')->first();
        $TC = $hocphan->SOCHI;
        if($TC <= 2){
            $this->validate([
                'HS11'=> 'required',
                'HS21'=> 'required',
            ]);
        }
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
