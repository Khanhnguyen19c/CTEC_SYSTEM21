<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Giangvien;
use App\Models\Sinhvien;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Toastr;
class DetailStudentOfTeacherComponent extends Component
{
    public $ID_SINHVIEN;

    public function mount($ID_SINHVIEN){
        $this->ID_SINHVIEN = $ID_SINHVIEN;
    }

    public function render()
    {
        $teacher = Giangvien::whereHas('user', function($q)
        {
            $q->where('TENDANGNHAP',Auth::user()->code)->WhereNull('deleted_at');

        })->first();
        $student = Sinhvien::join('lopchuyennganhs','lopchuyennganhs.ID_LOPCHUYENNGANH','sinhviens.ID_LOPCHUYENNGANH')
        ->where('ID_SINHVIEN',$this->ID_SINHVIEN)
        ->where('lopchuyennganhs.GVCN',$teacher->ID_GIANGVIEN)
        ->whereNull('lopchuyennganhs.deleted_at')
        ->whereNull('sinhviens.deleted_at')
        ->first();
        return view('livewire.teacher.detail-student-of-teacher-component',[
            'student' => $student
        ])->layout('layouts.layout',['title' => 'Thông Tin Sinh Viên '.$student->name.' '.$student->MALOPCHUYENNGANH]);
    }
}
