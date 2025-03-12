<?php

use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\SuperAdmin\UserController as SUPERADMINUSER;
use App\Http\Controllers\SuperAdmin\VideoController as SUPERADMINVIDEO;
use App\Http\Controllers\SuperAdmin\PhotoController as SUPERADMINPHOTO;
use App\Http\Controllers\SuperAdmin\SchoolController as SUPERADMINSCHOOL;
use App\Http\Controllers\Superadmin\ManageUserSchoolController as SUPERADMINMANAGE;




use App\Http\Controllers\TuSekolah\TuSekolahController;
use App\Http\Controllers\TuSekolah\SchoolController as TusekolahSCHOOL;
use App\Http\Controllers\TuSekolah\ClassController as TusekolahCLASS;
use App\Http\Controllers\TuSekolah\StudentController as TusekolahSTUDENT;
use App\Http\Controllers\TuSekolah\EreportController as TusekolahEREPORT;





use App\Http\Controllers\TuSekolah\UserController as TuUser;



use App\Http\Controllers\Guru\GuruController;
use App\Http\Controllers\Guru\UserController as GuruUser;
use App\Http\Controllers\Guru\StudentController as GuruStudent;
use App\Http\Controllers\Guru\SchoolController as GuruSchool;
use App\Http\Controllers\Guru\ClassController as GuruClass;
use App\Http\Controllers\Guru\EreportController as GuruEreport;
use App\Http\Controllers\Guru\NoteController as GuruNote;





use App\Http\Controllers\TuKeuangan\TuKeuanganController;
use App\Http\Controllers\OrangTua\OrangTuaController;
use App\Http\Controllers\KeuanganPusat\KeuanganPusatController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes([
    'register' => false, // Nonaktifkan rute registrasi
]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('superadmin')->middleware(['auth', 'level:SUPERADMIN'])->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');

    # Untuk Aksi Data Users
    Route::get('/users', [SUPERADMINUSER::class, 'index'])->name('superadmin.users.index');
    Route::post('/users', [SUPERADMINUSER::class, 'store'])->name('superadmin.users.store');
    Route::put('/users/{id}', [SUPERADMINUSER::class, 'update'])->name('superadmin.users.update');
    Route::delete('/users/{id}', [SUPERADMINUSER::class, 'destroy'])->name('superadmin.users.destroy');


    # Untuk Aksi Data Schools
    Route::get('/schools', [SUPERADMINSCHOOL::class, 'index'])->name('superadmin.schools.index');
    Route::post('/schools', [SUPERADMINSCHOOL::class, 'store'])->name('superadmin.schools.store');
    Route::put('/schools/{id}', [SUPERADMINSCHOOL::class, 'update'])->name('superadmin.schools.update');

    Route::delete('/schools/{id}', [SUPERADMINSCHOOL::class, 'destroy'])->name('superadmin.schools.destroy');

    # Untuk Aksi Data Schools
    Route::get('/students', [GuruStudent::class, 'index'])->name('superadmin.students.index');
    Route::post('/students', [SUPERADMINVIDEO::class, 'store'])->name('superadmin.students.store');
    Route::delete('/students/{id}', [GuruStudent::class, 'destroy'])->name('superadmin.students.destroy');

    # Untuk Aksi Data Videos
    Route::get('/videos', [SUPERADMINVIDEO::class, 'index'])->name('superadmin.videos.index');
    Route::post('/videos', [SUPERADMINVIDEO::class, 'store'])->name('superadmin.videos.store');
    Route::get('/videos/get-classes', [SUPERADMINVIDEO::class, 'getClasses'])->name('superadmin.videos.getClasses');
    Route::delete('/videos/{id}', [SUPERADMINVIDEO::class, 'destroy'])->name('superadmin.videos.destroy');


    # Untuk Aksi Data Photos
    Route::get('/photos', [SUPERADMINPHOTO::class, 'index'])->name('superadmin.photos.index');
    Route::get('/photos/get-classes', [SUPERADMINPHOTO::class, 'getClasses'])->name('superadmin.photos.getClasses');
    Route::get('/photos/get-students', [SUPERADMINPHOTO::class, 'getStudents'])->name('superadmin.photos.getStudents');


    Route::get('/manage-userschools', [SUPERADMINMANAGE::class, 'index'])->name('superadmin.manage-userschools');
    Route::post('/manage-userschools', [SUPERADMINMANAGE::class, 'store'])->name('superadmin.manage-userschools.store');
    Route::delete('/manage-userschools/{userId}/{schoolId}', [SUPERADMINMANAGE::class, 'destroy'])
        ->name('manage-userschools.destroy');
});


Route::prefix('tusekolah')->middleware(['auth', 'level:TUSEKOLAH'])->group(function () {
    Route::get('/dashboard', [TuSekolahController::class, 'index'])->name('tusekolah.dashboard');

    Route::get('/users', [TuUser::class, 'index'])->name('tusekolah.users.index');
    Route::delete('/users/{id}', [TuUser::class, 'destroy'])->name('users.destroy');

    # Untuk Aksi Data Schools
    Route::get('/schools', [TusekolahSCHOOL::class, 'index'])->name('tusekolah.schools.index');
    Route::post('/schools', [TusekolahSCHOOL::class, 'store'])->name('tusekolah.schools.store');
    Route::put('/schools/{id}', [TusekolahSCHOOL::class, 'update'])->name('tusekolah.schools.update');
    Route::delete('/schools/{id}', [TusekolahSCHOOL::class, 'destroy'])->name('tusekolah.schools.destroy');

    # Untuk Aksi Data Class
    Route::get('/classes', [TusekolahCLASS::class, 'index'])->name('tusekolah.classes.index');
    Route::post('/classes', [TusekolahCLASS::class, 'store'])->name('tusekolah.classes.store');
    Route::put('/classes/{id}', [TusekolahCLASS::class, 'update'])->name('tusekolah.classes.update');
    Route::delete('/classes/{id}', [TusekolahCLASS::class, 'destroy'])->name('tusekolah.classes.destroy');

    Route::get('/students', [TusekolahSTUDENT::class, 'index'])->name('tusekolah.students.index');


    Route::get('/ereports', [TusekolahEREPORT::class, 'index'])->name('tusekolah.ereports.index');
    Route::delete('/ereports/{id}', [TusekolahEREPORT::class, 'destroy'])->name('tusekolah.ereports.destroy');
});


Route::prefix('guru')->middleware(['auth', 'level:GURU'])->group(function () {
    Route::get('/dashboard', [GuruController::class, 'index'])->name('guru.dashboard');

    Route::get('/users', [GuruUser::class, 'index'])->name('guru.users.index');
    Route::delete('/users/{id}', [GuruUser::class, 'destroy'])->name('guru.destroy');

    Route::get('/student', [GuruStudent::class, 'index'])->name('guru.students.index');

    # Untuk Aksi Data Schools
    Route::get('/schools', [GuruSchool::class, 'index'])->name('guru.schools.index');
    Route::delete('/schools/{id}', [GuruSchool::class, 'destroy'])->name('guru.schools.destroy');

    # Untuk Aksi Data Class
    Route::get('/classes', [GuruClass::class, 'index'])->name('guru.classes.index');
    Route::delete('/classes/{id}', [GuruClass::class, 'destroy'])->name('guru.classes.destroy');

    Route::get('/eraports', [GuruEreport::class, 'index'])->name('guru.eraports.index');
    Route::delete('/eraports/{id}', [GuruEreport::class, 'destroy'])->name('guru.eraports.destroy');

    Route::get('/notes', [GuruNote::class, 'index'])->name('guru.notes.index');
    Route::delete('/notes/{id}', [GuruNote::class, 'destroy'])->name('guru.notes.destroy');
});






Route::prefix('tukeuangan')->middleware(['auth', 'level:TUKEUANGAN'])->group(function () {
    Route::get('/dashboard', [TuKeuanganController::class, 'index'])->name('tukeuangan.dashboard');
});

Route::prefix('tukeuanganpusat')->middleware(['auth', 'level:KEUANGANPUSAT'])->group(function () {
    Route::get('/dashboard', [KeuanganPusatController::class, 'index'])->name('keuanganpusat.dashboard');
});



Route::prefix('orangtua')->middleware(['auth', 'level:ORANGTUA'])->group(function () {
    Route::get('/dashboard', [OrangTuaController::class, 'index'])->name('orangtua.dashboard');
});
