<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Bacdaotao;
use App\Models\Chuyennganh;
use App\Models\Hedaotao;
use App\Models\Khoa;
use App\Models\Lopchuyennganh;
use App\Models\Nganh;
use App\Models\Sinhvien;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Toastr;
class EditStudentComponent extends Component
{
    use WithFileUploads;
    public $masv;
    public $hodem;
    public $ten;
    public $phai;
    public $ngaysinh;
    public $cmnd;
    public $ngaycap;
    public $noicap;
    public $noisinh;
    public $email;
    public $sodienthoai;
    public $sodienthoai2;
    public $dantoc;
    public $tongiao;
    public $dienchinhsach;
    public $doituonguutien;
    public $tpgiadinh;
    public $trinhdovanhoa;
    public $ngayketnapdoan;
    public $noiketnapdoan;
    public $ngayketnapdang;
    public $noiketnapdang;
    public $quatrinhcongtac;
    public $diachilienlac;
    public $hotenvochong;
    public $nghenghiepvochong;
    public $hinhanh;
    public $hotencha;
    public $namsinhcha;
    public $dantoccha;
    public $tongiaocha;
    public $nghecha;
    public $sodienthoaicha;
    public $hotenme;
    public $namsinhme;
    public $dantocme;
    public $tongiaome;
    public $ngheme;
    public $sodienthoaime;
    public $diachichame;
    public $baoluu;
    public $sohoso;
    public $datotnghiep;
    public $id_hedaotao;
    public $id_bacdaotao;
    public $hinhhoso;
    public $hinhdaidien;
    public $hokhau;
    public $ccatinhoc;
    public $ccaanhvan;
    public $sotaikhoan;
    public $department;

    public $ghichu;
    public $ngayvaotruong;
    public $namvaotruong;
    public $ID_SINHVIEN;

    public $nganh;
    public $lopchuyennganh;
    public $khoa;
    public $selectednganh = null;
    public $selectedkhoa = null;
    public $selectedlopchuyennganh = null;
    public $newhinhhoso;
    public $newhinhdaidien;

    private function validator(){
        return [
            'selectednganh'=>'required',
            'selectedkhoa' => 'required',
            'selectedlopchuyennganh' => 'required',
            'masv'=> 'required',
            'hodem'=> 'required',
            'ten'=> 'required',
            'phai'=> 'required',
            'ngaysinh'=> 'required',
            // 'cmnd'=> 'required',
            // 'ngaycap'=> 'required',
            // 'noicap'=> 'required',
            // 'noisinh'=> 'required',
            // 'email'=> 'required',
            // 'sodienthoai'=> 'required|numeric',
            // 'dantoc'=> 'required',
            // 'tongiao'=> 'required',
            // 'tpgiadinh'=> 'required',
            // 'trinhdovanhoa'=> 'required',
            // 'quatrinhcongtac'=> 'required',
            // 'diachilienlac'=> 'required',
            // 'hotencha'=> 'required',
            // 'namsinhcha'=> 'required',
            // 'dantoccha'=> 'required',
            // 'tongiaocha'=> 'required',
            // 'nghecha'=> 'required',
            // 'sodienthoaicha'=> 'required',
            // 'hotenme'=> 'required',
            // 'namsinhme'=> 'required',
            // 'dantocme'=> 'required',
            // 'tongiaome'=> 'required',
            // 'ngheme'=> 'required',
            // 'diachichame'=> 'required',
            // 'baoluu'=> 'required',
            // 'sohoso'=> 'required|unique:sinhviens',
            // 'id_hedaotao'=> 'required',
            // 'id_bacdaotao'=> 'required',
            // 'hinhhoso'=> 'mimes:jpeg,png|max:1024',
            // 'hinhdaidien'=> 'mimes:jpeg,png|max:1024',
            // 'hokhau'=> 'required',
            // 'ccatinhoc'=> 'required',
            // 'ccaanhvan'=> 'required',
            // 'ngayvaotruong'=>'required',
            // 'namvaotruong'=>'required',
        ];
    }
    public function updated($fields){
        $this->validateOnly($fields,$this->validator());
    }

    public function mount($id){
        $student = Sinhvien::where('ID_SINHVIEN',$id)->first();

        $this->selectednganh = $student->ID_NGANH;
        $this->selectedlopchuyennganh = $student->ID_LOPCHUYENNGANH;
        $this->masv = $student->MASV;
        $this->hodem = $student->HODEM;
        $this->ten = $student->TEN;
        $this->phai = $student->PHAI;
        $this->ngaysinh = $student->NGAYSINH;
        $this->cmnd = $student->CMND;
        $this->ngaycap = $student->NGAYCAP;
        $this->noicap = $student->NOICAP;
        $this->noisinh = $student->NOISINH;
        $this->email = $student->EMAIL;
        $this->sodienthoai = $student->SODIENTHOAI;
        $this->sodienthoai2 = $student->SODIENTHOAI2;
        $this->dantoc = $student->DANTOC;
        $this->tongiao = $student->TONGIAO;
        $this->dienchinhsach = $student->DIENCHINHSACH;
        $this->doituonguutien = $student->DOITUONGUUTIEN;
        $this->tpgiadinh = $student->TPGIADINH;
        $this->trinhdovanhoa = $student->TRINHDOVANHOA;
        $this->ngayketnapdoan = $student->NGAYKETNAPDOAN;
        $this->noiketnapdoan = $student->NOIKETNAPDOAN;
        $this->ngayketnapdang = $student->NGAYKETNAPDANG;
        $this->noiketnapdang = $student->NOIKETNAPDANG;
        $this->quatrinhcongtac = $student->QUATRINHCONGTAC;
        $this->diachilienlac = $student->DIACHILIENLAC;
        $this->hotenvochong = $student->HOTENVOCHONG;
        $this->nghenghiepvochong = $student->NGHENGHIEPVOCHONG;
        $this->hinhanh = $student->HINHANH;
        $this->hotencha = $student->HOTENCHA;
        $this->namsinhcha = $student->NAMSINHCHA;
        $this->dantoccha = $student->DANTOCCHA;
        $this->tongiaocha = $student->TONGIAOCHA;
        $this->nghecha = $student->NGHECHA;
        $this->sodienthoaicha = $student->SODIENTHOAICHA;
        $this->hotenme = $student->HOTENME;
        $this->namsinhme = $student->NAMSINHME;
        $this->dantocme = $student->DANTOCME;
        $this->tongiaome = $student->TONGIAOME;
        $this->ngheme = $student->NGHEME;
        $this->sodienthoaime = $student->SODIENTHOAIME;
        $this->diachichame = $student->DIACHICHAME;
        $this->baoluu = $student->BAOLUU;
        $this->sohoso = $student->SOHOSO;
        $this->datotnghiep = $student->DATOTNGHIEP;
        $this->id_hedaotao = $student->ID_HEDAOTAO;
        $this->id_bacdaotao = $student->ID_BACDAOTAO;
        $this->hinhhoso = $student->HINHHOSO;
        $this->hinhdaidien = $student->HINHDAIDIEN;
        $this->hokhau = $student->HOKHAU;
        $this->ccatinhoc = $student->CCATINHOC;
        $this->ccaanhvan = $student->CCAANHVAN;
        $this->sotaikhoan = $student->SOTKNGANHANG;
        $this->selectedkhoa = $student->ID_KHOA;
        $this->ghichu = $student->GHICHU;
        $this->ngayvaotruong = $student->NGAYVAOTRUONG;
        $this->namvaotruong = $student->NAMNHAPHOC;
        $this->ID_SINHVIEN = $student->ID_SINHVIEN;

        $this->khoa = Khoa::whereNull('deleted_at')->get();
        $this->nganh = Nganh::whereNull('deleted_at')->get();
        $this->lopchuyennganh = Chuyennganh::whereNULL('deleted_at')->get();

    }
    //update student
    public function update_student(){
        $this->validate($this->validator());
        if($this->newhinhdaidien){
            if($this->hinhdaidien != null){
                unlink('assets/images/Students' . '/' . $this->hinhdaidien);
            }
            $imageName = Carbon::now()->timestamp. '.' . $this->newhinhdaidien->extension();
            $this->newhinhdaidien->storeAs('Students',$imageName);
            $this->newhinhdaidien = $imageName;
        }else{
            $this->newhinhdaidien = $this->hinhdaidien;
        }
        if($this->newhinhhoso){
            if($this->hinhhoso != null){
                unlink('assets/images/Hoso' . '/' . $this->hinhhoso);
            }
            $imageNames = Carbon::now()->timestamp. '.' . $this->newhinhhoso->extension();
            $this->newhinhhoso->storeAs('Hoso',$imageNames);
            $this->newhinhhoso = $imageNames;
        }else{
            $this->newhinhhoso = $this->hinhhoso;
        }
    try{
        DB::table('sinhviens')->where('ID_SINHVIEN',$this->ID_SINHVIEN)->update([
            'ID_LOPCHUYENNGANH' => $this->selectedlopchuyennganh,
            'ID_NGANH' => $this->selectednganh,
            'NGAYVAOTRUONG' => $this->ngayvaotruong,
            'NAMNHAPHOC' => $this->namvaotruong,
            'DATOTNGHIEP' => 0,
            'CANHBAOHV' => 0,
            'GHICHU' => $this->ghichu,
            'CANHBAOHV' => 0,
            'MASV' => $this->masv,
            'HODEM' => $this->hodem,
            'TEN' => $this->ten,
            'PHAI' => $this->phai,
            'NGAYSINH' => $this->ngaysinh,
            'CMND' => $this->cmnd,
            'NGAYCAP' => $this->ngaycap,
            'NOICAP' => $this->noicap,
            'NOISINH' => $this->noisinh,
            'EMAIL' => $this->email,
            'SODIENTHOAI' => $this->sodienthoai,
            'SODIENTHOAI2' => $this->sodienthoai2,
            'DANTOC' => $this->dantoc,
            'TONGIAO' => $this->tongiao,
            'DIENCHINHSACH' => $this->dienchinhsach,
            'DOITUONGUUTIEN' => $this->doituonguutien,
            'TPGIADINH' => $this->tpgiadinh,
            'TRINHDOVANHOA' => $this->trinhdovanhoa,
            'NGAYKETNAPDOAN' => $this->ngayketnapdoan,
            'NOIKETNAPDOAN' => $this->noiketnapdoan,
            'NGAYKETNAPDANG' => $this->ngayketnapdang,
            'NOIKETNAPDANG' => $this->noiketnapdang,
            'QUATRINHCONGTAC' => $this->quatrinhcongtac,
            'DIACHILIENLAC' => $this->diachilienlac,
            'HOTENVOCHONG' => $this->hotenvochong,
            'NGHENGHIEPVOCHONG' => $this->nghenghiepvochong,
            'HINHANH' => $this->hinhanh,
            'HOTENCHA' => $this->hotencha,
            'NAMSINHCHA' => $this->namsinhcha,
            'DANTOCCHA' => $this->dantoccha,
            'TONGIAOCHA' => $this->tongiaocha,
            'NGHECHA' => $this->nghecha,
            'SODIENTHOAICHA' => $this->sodienthoaicha,
            'HOTENME' => $this->hotenme,
            'NAMSINHME' => $this->namsinhme,
            'DANTOCME' => $this-> dantocme,
            'TONGIAOME' => $this-> tongiaome,
            'NGHEME' => $this->ngheme,
            'SODIENTHOAIME' => $this->sodienthoaime,
            'DIACHICHAME' => $this->diachichame,
            'BAOLUU' => $this->baoluu,
            'SOHOSO' => $this->sohoso,
            'DATOTNGHIEP' => $this->datotnghiep,
            'ID_HEDAOTAO' => $this->id_hedaotao,
            'ID_BACDAOTAO' => $this->id_bacdaotao,
            'HINHHOSO' => $this->newhinhhoso,
            'HINHDAIDIEN' => $this->newhinhdaidien,
            'HOKHAU' => $this->hokhau,
            'CCATINHOC' => $this->ccatinhoc,
            'CCAANHVAN' => $this->ccaanhvan,
            'SOTKNGANHANG' => $this->sotaikhoan,
            'ID_KHOA' => $this->selectedkhoa,
            ]);
        }catch(ModelNotFoundException){
            return Toastr::error('Lỗi cập nhật dữ liệu','Thất bại');
        }
            Toastr::success('Cập nhật dữ liệu sinh viên thành công','Thông báo');
            return Redirect()->route('student_list');

    }
    public function render()
    {
        $nganhs = Nganh::whereNull('deleted_at')->get();
        $bacdaotaos = Bacdaotao::all();
        $hedaotaos = Hedaotao::all();
        $departments = Khoa::whereNull('deleted_at')->get();
        return view('livewire.teacher.edit-student-component',[
            'bacdaotaos' => $bacdaotaos,
            'hedaotaos' => $hedaotaos,
            'departments' => $departments,
            'nganhs' => $nganhs,
        ])->layout('layouts.layout',['title' => 'Trang Cập Nhật Thông Tin Sinh Viên CTEC']);
    }

    public function updatedselectedkhoa($ID_KHOA)
    {
        $this->nganh = Nganh::where('ID_KHOA', $ID_KHOA)->whereNULL('deleted_at')->get();
    }
    public function updatedselectednganh($ID_NGANH)
    {
        if (!is_null($ID_NGANH)) {
        $this->lopchuyennganh = Chuyennganh::where('ID_NGANH',$ID_NGANH)->whereNULL('deleted_at')->get();
        $this->selectedlopchuyennganh = NULL;
        }
    }
}
