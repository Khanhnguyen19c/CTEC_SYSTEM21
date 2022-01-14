<?php

use App\Http\Livewire\ChatAppComponent;
use App\Http\Livewire\ContactComponent;
use App\Http\Livewire\EducationProgramComponent;
use App\Http\Livewire\ProfileComponent;
use App\Http\Livewire\Student\AllPersonalScoreboardComponent;
use App\Http\Livewire\Student\Dashboardcomponent;
use App\Http\Livewire\Student\PersonalScoreboardComponent;
use App\Http\Livewire\Teacher\AddCourseScoreComponent;
use App\Http\Livewire\Teacher\AddStudentComponent;
use App\Http\Livewire\Teacher\AddTeacherComponent;
use App\Http\Livewire\Teacher\DetailsClassModuleComponent;
use App\Http\Livewire\Teacher\DetailStudentComponent;
use App\Http\Livewire\Teacher\DetailStudentOfTeacherComponent;
use App\Http\Livewire\Teacher\EditCourseScoreComponent;
use App\Http\Livewire\Teacher\EditStudentComponent;
use App\Http\Livewire\Teacher\EditTeacherConponent;
use App\Http\Livewire\Teacher\ListBranchComponent;
use App\Http\Livewire\Teacher\ListClassComponent;
use App\Http\Livewire\Teacher\ListClassModuleComponent;
use App\Http\Livewire\Teacher\ListClassOfTeacherComponent;
use App\Http\Livewire\Teacher\ListCourseScoreComponent;
use App\Http\Livewire\Teacher\ListDepartmentComponent;
use App\Http\Livewire\Teacher\ListModuleComponent;
use App\Http\Livewire\Teacher\ListRolesComponent;
use App\Http\Livewire\Teacher\ListScoreOfTeacherComponent;
use App\Http\Livewire\Teacher\ListSpecializedCompoent;
use App\Http\Livewire\Teacher\ListStudentComponent;
use App\Http\Livewire\Teacher\ListTeacherComponent;
use App\Http\Livewire\Teacher\ListTeacherRolesComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', Dashboardcomponent::class)->name('home');
    Route::get('/dashboard', Dashboardcomponent::class);
     //chat
    Route::get('/chat', ChatAppComponent::class)->name('chatapp');
     //contact
    route::get('/contact',ContactComponent::class)->name('contact');
//for Student
    Route::middleware(['AuthStudent'])->group(function () {
        //profile
        Route::get('/profile', ProfileComponent::class)->name('profile');
        //bang-diem
        Route::get('/bang-diem', PersonalScoreboardComponent::class)->name('scoreboard_list');
        //bang-diem full
        Route::get('/ket-qua', AllPersonalScoreboardComponent::class)->name('allscoreboard_list');
         //chương trình đào tạo
        Route::Get('/Education-Program', EducationProgramComponent::class)->name('education_program');

    });
//for teacher
    Route::middleware(['auth:sanctum', 'verified', 'AuthTeacher'])->group(function () {
        Route::prefix('teacher')->group(function () {
            //all teacher
            Route::get('/list', ListTeacherComponent::class)->name('teacher_list')->middleware('can:QLDT');
            //add teacher
            Route::get('/add', AddTeacherComponent::class)->name('teacher_add')->middleware('can:QLDT');
            //edit teacher
            Route::get('/edit/{id}', EditTeacherConponent::class)->name('teacher_edit')->middleware('can:QLDT');

            //delete teacher
            Route::get('/delete/{id}', [ListTeacherComponent::class, 'delete_teacher'])->name('teacher_delete')->middleware('can:QLDT');

            //detail teacher
            Route::get('/reset/{ID_GIANGVIEN}', [ListTeacherComponent::class,'resetPass'])->name('teacher_resetpass')->middleware('can:QLDT');
            //change pass teacher

        });
        Route::prefix('student')->group(function () {
            //all student
            Route::get('/list', ListStudentComponent::class)->name('student_list')->middleware('can:QLDT');
            //details student
            Route::get('/details/{ID_SINHVIEN}', DetailStudentComponent::class)->name('student_details')->middleware('can:QLDT');
            //add student
            Route::get('/add', AddStudentComponent::class)->name('student_add')->middleware('can:QLDT');
            //edit student
            Route::get('/edit/{id}', EditStudentComponent::class)->name('student_edit')->middleware('can:QLDT');
            //import excel
            Route::post('/import', [ListStudentComponent::class, 'import'])->name('import_student')->middleware('can:QLDT');
        });
        //all class
        Route::get('class/list', ListClassComponent::class)->name('class_list')->middleware('can:QLDT');

        //all specialized
        Route::get('/specialized/list', ListSpecializedCompoent::class)->name('specialized_list')->middleware('can:QLDT');

        //all Branch
        Route::get('/branch/list', ListBranchComponent::class)->name('branch_list')->middleware('can:QLDT');

        //all department
        Route::get('/department/list', ListDepartmentComponent::class)->name('department_list')->middleware('can:QLDT');
        //all module
        Route::get('/module/list', ListModuleComponent::class)->name('module_list')->middleware('can:QLDT');
        //all module
        Route::get('/class-module/list', ListClassModuleComponent::class)->name('classmodule_list')->middleware('can:QLDT');
        //all module
        Route::get('/course-score/list', ListCourseScoreComponent::class)->name('coursescore_list');
        //delete module
        Route::get('/course-score/delete/{id}', [ListCourseScoreComponent::class, 'coursescore_delete'])->name('coursescore_delete');
        //add module
        Route::get('/course-score/add', AddCourseScoreComponent::class)->name('coursescore_add');
        Route::post('/course-score/add/excel', [AddCourseScoreComponent::class,'import_score'])->name('import_score');

        //edit module
        Route::get('/course-score/edit/{ID_SINHVIEN}/{ID_LOPHOCPHAN?}', EditCourseScoreComponent::class)->name('coursescore_edit');

        // danh sách lớp của giáo viên
        Route::get('/class-teacher/list', ListClassOfTeacherComponent::class)->name('classOfteacher');
        Route::get('/class-teacher/details/{ID_SINHVIEN}', DetailStudentOfTeacherComponent::class)->name('student_detailsOfteacher');
        Route::post('/exportOfClass', [ListClassOfTeacherComponent::class, 'export'])->name('export_student');
        Route::get('/score-student/{ID_SINHVIEN}', ListScoreOfTeacherComponent::class)->name('scoreOfteacher');

        //details module
        Route::get('/class-module/detail/{id}', DetailsClassModuleComponent::class)->name('detail_classmodule')->middleware('can:QLDT');

        //list roles
        Route::get('/roles/list', ListRolesComponent::class)->name('roles_list')->middleware('can:QLDT');
        //list roles
        Route::get('/Teacher/permissions/list', ListTeacherRolesComponent::class)->name('Teacherroles_list')->middleware('can:QLDT');
    });
});
