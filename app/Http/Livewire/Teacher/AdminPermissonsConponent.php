<?php

namespace App\Http\Livewire\Teacher;

use App\Models\QuyenGv;
use Illuminate\Http\Client\Request;
use Livewire\Component;

class AdminPermissonsConponent extends Component
{
    public function store(Request $request){
        $permissions = new QuyenGv();
        $permissions->name = $request->module_parent;
        $permissions->display_name = $request->module_parent;
        $permission_id = 0;
        $permissions->parent_id  = $permission_id;
        $permissions->save();
        foreach($request->module_childrent as $item){
         $permissions->name = $item;
         $permissions->display_name = $item;
         $permissions->parent_id = $permission_id;
         $permissions->key_code = $request->module_parent. '_' . $item;
         $permissions->save();
        }
        session()->flash('message','Cập nhật thành công rôi!');
        return redirect()->back();
     }
    public function render()
    {
        return view('livewire.teacher.admin-permissons-conponent')->layout('layouts.layout');
    }
}
