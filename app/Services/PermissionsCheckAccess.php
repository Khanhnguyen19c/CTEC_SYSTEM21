<?php
  namespace App\Services;

  use Illuminate\Support\Facades\Gate;

class PermissionsCheckAccess{
    public function setGatePolicyAccess(){
        // $this->defineGateTeachers();
        // $this->defineGateStudents();
        // $this->defineGatQLDT();
        // $this->defineGateBranch();
        // $this->defineGateClass();
        // $this->defineGateClassModule();
        // $this->defineGateStudentClassModule();
        // $this->defineGateSpecialized();
    }


// //teachers permission
// public function defineGateTeachers(){
//     Gate::define('teachers-list', 'App\\Policies\TeachersPolicy@view');
//     Gate::define('teachers-add', 'App\\Policies\CategoryPolicy@create');
//     Gate::define('teachers-edit', 'App\\Policies\CategoryPolicy@update');
//     Gate::define('teachers-delete', 'App\\Policies\CategoryPolicy@delete');
//    }

//     //students permission
//  public function defineGateStudents(){
//     Gate::define('students-list', 'App\\Policies\StudentsPolicy@view');
//     Gate::define('students-add', 'App\\Policies\StudentsPolicy@create');
//     Gate::define('students-delete', 'App\\Policies\StudentsPolicy@delete');
//     Gate::define('students-details', 'App\\Policies\StudentsPolicy@details');
//    }

//     //Branch permission
//  public function defineGateBranch(){
//     Gate::define('branch-list', 'App\\Policies\BranchPolicy@view');
//     Gate::define('branch-add', 'App\\Policies\BranchPolicy@create');
//     Gate::define('branch-edit', 'App\\Policies\BranchPolicy@update');
//     Gate::define('branch-delete', 'App\\Policies\BranchPolicy@delete');
//    }

//     //department permission
//  public function defineGateDepartment(){
//     Gate::define('department-list', 'App\\Policies\DepartmentPolicy@view');
//     Gate::define('department-add', 'App\\Policies\DepartmentPolicy@create');
//     Gate::define('department-edit', 'App\\Policies\DepartmentPolicy@update');
//     Gate::define('department-delete', 'App\\Policies\DepartmentPolicy@delete');
//    }
//    //class permission
//  public function defineGateClass(){
//     Gate::define('class-list', 'App\\Policies\ClassPolicy@view');
//     Gate::define('class-add', 'App\\Policies\ClassPolicy@create');
//     Gate::define('class-edit', 'App\\Policies\ClassPolicy@update');
//     Gate::define('class-delete', 'App\\Policies\ClassPolicy@delete');
//    }
//     //lớp hoc phần permission
//  public function defineGateClassModule(){
//     Gate::define('classModule-list', 'App\\Policies\ClassModulePolicy@view');
//     Gate::define('classModule-add', 'App\\Policies\ClassModulePolicy@create');
//     Gate::define('classModule-edit', 'App\\Policies\ClassModulePolicy@update');
//     Gate::define('classModule-delete', 'App\\Policies\ClassModulePolicy@delete');

//    }
//      //sinh viên lớp học phàn permission
//  public function defineGateStudentClassModule(){
//     Gate::define('StudentclassModule-list', 'App\\Policies\StudentClassModulePolicy@view');
//     Gate::define('StudentclassModule-add', 'App\\Policies\StudentClassModulePolicy@create');
//     Gate::define('StudentclassModule-delete', 'App\\Policies\StudentClassModulePolicy@delete');

//    }
//    //chuyen ngành permission
//  public function defineGateSpecialized(){
//     Gate::define('specialized-list', 'App\\Policies\SpecializedPolicy@view');
//     Gate::define('specialized-add', 'App\\Policies\SpecializedPolicy@create');
//     Gate::define('specialized-edit', 'App\\Policies\SpecializedPolicy@update');
//     Gate::define('specialized-delete', 'App\\Policies\SpecializedPolicy@delete');
//    }
}
