<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Bacdaotao;
use App\Models\Chuyennganh;
use App\Models\Hedaotao;
use App\Models\Khoa;
use App\Models\Lopchuyennganh;
use App\Models\Nganh;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Toastr;
class AddStudentComponent extends Component
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

    public $nganh;
    public $lopchuyennganh;
    public $khoa;
    public $selectednganh = null;
    public $selectedkhoa = null;
    public $selectedlopchuyennganh = null;
    private function validator(){
        return [
            'selectednganh'=>'required',
            'selectedkhoa' => 'required',
            'selectedlopchuyennganh' => 'required',
            'masv'=> 'required|unique:sinhviens',
            'hodem'=> 'required',
            'ten'=> 'required',
            'phai'=> 'required',
            'ngaysinh'=> 'required',
            'cmnd'=> 'required',
            'ngaycap'=> 'required',
            'noicap'=> 'required',
            'noisinh'=> 'required',
            'email'=> 'required',
            'sodienthoai'=> 'required|numeric',
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

    public function save_student(){
        $this->validate($this->validator());
        $imageName = '';
        $imageNameHOSO = '';
        if($this->hinhdaidien){
            $imageName = Carbon::now()->timestamp. '.' . $this->hinhdaidien->extension();
            $this->hinhdaidien->storeAs('Students',$imageName);
        }if($this->hinhdaidien){
            $imageNameHOSO = Carbon::now()->timestamp. '.' . $this->hinhdaidien->extension();
            $this->hinhhoso->storeAs('Hoso',$imageNameHOSO);
        }
        $user_student = new User();
        $user_student->code = $this->masv;
        $user_student->name = $this->hodem.' '.$this->ten;
        $user_student->email = $this->email;
        $user_student->utype = 'Student';
        $user_student->password = Hash::make($this->masv.substr($this->cmnd,-4));
    try{
        $user_student->save();
        DB::table('sinhviens')->insert([
            'ID_KHOA' => $this->selectedkhoa,
            'ID_LOPCHUYENNGANH' => $this->selectedlopchuyennganh,
            'ID_NGANH' => $this->selectednganh,
            'NGAYVAOTRUONG' => $this->ngayvaotruong,
            'NAMNHAPHOC' => $this->namvaotruong,
            'DATOTNGHIEP' => 0,
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
            'HINHHOSO' => $imageNameHOSO,
            'HINHDAIDIEN' => $imageName,
            'HOKHAU' => $this->hokhau,
            'CCATINHOC' => $this->ccatinhoc,
            'CCAANHVAN' => $this->ccaanhvan,
            'SOTKNGANHANG' => $this->sotaikhoan,
            ]);
        }catch(ModelNotFoundException){
            return Toastr::error('Lỗi thêm dữ liệu','Thất bại');
        }
            Toastr::success('Thêm dữ liệu sinh viên thành công','Thông báo');
            return Redirect()->route('student_list');
    }

    public function mount()
    {
        $this->khoa = Khoa::whereNull('deleted_at')->get();
        $this->nganh = collect();
        $this->lopchuyennganh = collect();
    }
    public function render()
    {
        $bacdaotaos = Bacdaotao::all();
        $hedaotaos = Hedaotao::all();
        return view('livewire.teacher.add-student-component',[
            'bacdaotaos' => $bacdaotaos,
            'hedaotaos' => $hedaotaos,

        ])->layout('layouts.layout',['title' => 'Trang Thêm Sinh Viên CTEC']);
    }

    public function updatedselectedkhoa($ID_KHOA)
    {
        $this->nganh = Nganh::where('ID_KHOA', $ID_KHOA)->get();
    }
    public function updatedselectednganh($ID_NGANH)
    {

        if (!is_null($ID_NGANH)) {
        $this->lopchuyennganh = Chuyennganh::where('ID_NGANH',$ID_NGANH)->get();
        $this->selectedlopchuyennganh = NULL;
        }
    }

}
