<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Quyen;
use App\Models\QuyenGv;
use Illuminate\Http\Client\Request;
use Livewire\Component;

class AdminRolesComponent extends Component
{
    public $name;
    public $display_name;
    public $role_id;
    public $showEditModal = False;

    //delete brand
    public function deleteRole($role_id){
        $role = Quyen::find($role_id);
        $permissions = QuyenGv::where('ID_GVQUYEN',$role_id)->get();
        foreach($permissions as $permission){
            $permission->delete();
        }
        $role->delete();
        session()->flash('message','Xoá vai trò thành công');
    }


    public function render()
    {
        $permissions = QuyenGv::where('parent_id',0)->get();
        $roles = Quyen::all();
        return view('livewire.teacher.admin-roles-component',['roles'=>$roles,'permissions'=>$permissions])->layout('layouts.layout');
    }
}
