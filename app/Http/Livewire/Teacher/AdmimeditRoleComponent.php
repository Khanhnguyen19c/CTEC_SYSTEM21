<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Quyen;
use App\Models\QuyenGv;
use Illuminate\Http\Client\Request;
use Livewire\Component;

class AdmimeditRoleComponent extends Component
{
        public $checked;
        public $name;
        public $display_name;
        public $role_id;
        public $role;

        public function mount($role_id){
            $this->role = Quyen::find($role_id);
            $this->name = $this->role->name;
            $this->display_name = $this->role->display_name;
            $this->role_id = $role_id;
            $this->checked = $this->role->permissions;
        }
        // public function updated($key,$value){
        //     $exlode = Str::of($key)->explode('.');
            //value = value selectGroup
            //key = lệnh selectall
            //exlode = permission id
            //$exlode[0] = lệnh group all
            //$exlode[1] = permission id
        //     if($exlode[0] === 'selectAll' && empty($value)){
        //         $permissions = Permission::pluck('id')->map(fn($id) => (string)$id)->toArray();
        //         $this->selected = array_values(array_unique(array_merge_recursive($this->selected,$permissions)));
        //     }elseif($exlode[0] === 'selectGroup' && is_numeric($value)){
        //         $permissions = Permission::where('parent_id',$value)->pluck('id')->map(fn($id) => (string)$id)->toArray();
        //         $this->selected = array_values(array_unique(array_merge_recursive($this->selected,$permissions)));
        //     }
        //     elseif($exlode[0] === 'selectGroup' && empty($value)){
        //         $permissions = Permission::where('parent_id',$exlode[1])->pluck('id')->map(fn($id) => (string)$id)->toArray();
        //         $this->selected = array_merge(array_diff($this->selected, $permissions));
        //     }

            // if($value){
            //     $this->check_childrent = Permission::pluck('id');
            // }else{
            //     $this->check_childrent = [];
            // }
        // }

        public function updateRole(Request $request){
            //  dd($request->all());
                $role = Quyen::find($request->role_id);
                $role->MA_QUYEN = $request->name;
                $role->DIENGIAI= $request->display_name;
                $role->save();
                $role->quyengv()->sync($request->rolesChildrent);
                session()->flash('message','Cập nhật vai trò thành công!');
                return redirect()->back();
        }

        public function render()
        {
                $checked = $this->role->permissions;
                $permissions = QuyenGv::where('parent_id',0)->get();
        return view('livewire.teacher.admimedit-role-component',['permissions'=>$permissions,'checked'=>$checked])->layout('layouts.layout)');
    }
}
