<?php

return
 [
     'access' =>[
         //giáo viên
         'teachers-list' => 'teachers_list',
         'teachers-add' => 'teachers_add',
         'teachers-edit' => 'teachers_edit',
         'teachers-delete' => 'teachers_delete',
        //học sinh
         'students-list' => 'students_list',
         'students-details' => 'students_details',
         'students-delete' => 'students_delete',
         'students-edit' => 'students_edit',
         'students-add' => 'students_add',
        //chuyên ngành
         'branch-list' => 'branch_list',
         'branch-delete' => 'branch_delete',
         'branch-edit' => 'branch_edit',
         'branch-add' => 'branch_add',
        //khoa
         'department-list' => 'department_list',
         'department-delete' => 'department_delete',
         'department-edit' => 'department_edit',
         'department-add' => 'department_add',
        //lớp chuyên ngành
         'class-list' => 'class_list',
         'class-delete' => 'class_delete',
         'class-edit' => 'class_edit',
         'class-add' => 'class_add',
        //lớp học phần
         'classModule-list' => 'classModule_list',
         'classModule-delete' => 'classModule_delete',
         'classModule-edit' => 'classModule_edit',
         'classModule-add' => 'classModule_add',

        //sinh viên lớp học phần
         'StudentclassModule-list' => 'spedcialized_list',
         'StudentclassModule-add' => 'spedcialized_add',
         'StudentclassModule-delete' => 'spedcialized_delete',

       //chuyên ngành
        'specialized-list' => 'specialized_list',
        'specialized-delete' => 'specialized_delete',
        'specialized-edit' => 'specialized_edit',
        'specialized-add' => 'specialized_add',
     ],
     'table_module' => [
        'teachers',
        'students',
        'branch',
        'department',
        'class',
        'classModule',
        'StudentclassModule',
        'specialized',
    ],
    'module_childrent' => [
        'list',
        'add',
        'edit',
        'delete',
    ],
     ];

?>
