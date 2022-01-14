<?php

namespace App\Http\Livewire\Teacher;

use App\Exports\ExportCourseScore;
use App\Models\Giangvien;
use App\Models\Ketquahocphan;
use App\Models\Lophocphan;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Toastr;
class ListCourseScoreComponent extends Component
{
    use WithPagination;
    public $pageSize;
    public $ID_LOPHOCPHAN;
    public $teacher;
    public function mount(){
        $this->pageSize = 20 ;
        $this->teacher = Giangvien::whereHas('user', function($q)
        {
            $q->where('TENDANGNHAP',Auth::user()->code)->WhereNull('deleted_at');

        })->first();
    }

    public function coursescore_delete($id){
        $course_score = Ketquahocphan::where('ID_KETQUAHOCPHAN',$id)->whereNull('deleted_at')->first();
        $course_score->deleted_at= Carbon::now();
        $course_score->save();
        Toastr::success('Xoá bảng điểm học phần thành công','Thông báo');
        return Redirect()->route('coursescore_list');
    }
    public function exportCourseScore(){
        $title_score = Lophocphan::where('lophocphans.ID_LOPHOCPHAN',$this->ID_LOPHOCPHAN)
        ->WhereNull('lophocphans.deleted_at')->first();
        return (new ExportCourseScore($this->ID_LOPHOCPHAN))->download('Bảng điểm lớp '.$title_score->MALOPHOCPHAN.'.xlsx');
    }
    public function render()
    {
        $years = Carbon::now()->format('Y');
        if($this->ID_LOPHOCPHAN){
            $course_score = Ketquahocphan::join('lophocphans','lophocphans.ID_LOPHOCPHAN','=','ketquahocphan.ID_LOPHOCPHAN')
            ->whereHas('lophocphan', function($q){
                $q->where('ID_GIAOVIEN',$this->teacher->ID_GIANGVIEN)
                ->where('ID_LOPHOCPHAN',$this->ID_LOPHOCPHAN)
                ->WhereNull('deleted_at');
            })
            ->where(function($query) use ($years){
                    $query->where('NIENKHOA', 'LIKE', '%'.$years.'%' )
                          ->ORwhere('NIENKHOA', 'LIKE', '%'.($years - 1).'%' );
            })
            ->whereNull('ketquahocphan.deleted_at')->paginate($this->pageSize);
        }else{
            $course_score = Ketquahocphan::join('lophocphans','lophocphans.ID_LOPHOCPHAN','=','ketquahocphan.ID_LOPHOCPHAN')
            ->whereHas('lophocphan', function($q){
                $q->where('ID_GIAOVIEN',$this->teacher->ID_GIANGVIEN)
                ->WhereNull('deleted_at');
            })
            ->where(
                function($query) use ($years){
                    $query->where('NIENKHOA', 'LIKE', '%'.$years.'%' )
                          ->ORwhere('NIENKHOA', 'LIKE', '%'.($years - 1).'%' );
            })
            ->whereNull('ketquahocphan.deleted_at')->paginate($this->pageSize);
        }

        $title_class = Lophocphan::where('ID_GIAOVIEN',$this->teacher->ID_GIANGVIEN)
        ->where(function($query) use ($years){
            $query->where('NIENKHOA', 'LIKE', '%'.$years.'%' )
                  ->ORwhere('NIENKHOA', 'LIKE', '%'.($years - 1).'%' );
    })
         ->WhereNull('deleted_at')->get();
        return view('livewire.teacher.list-course-score-component',[
            'course_score' => $course_score,
            'title_class' =>$title_class,
        ])->layout('layouts.layout',['title' => 'Trang Quản Lý Kết Qủa Học Phần CTEC']);
    }
}
