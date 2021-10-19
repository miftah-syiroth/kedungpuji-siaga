<?php

use App\Http\Controllers\CoupleController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\Invokeables\DeadPerson;
use App\Http\Controllers\Invokeables\FamilyMemberDelete;
use App\Http\Controllers\Invokeables\FamilyMemberStore;
use App\Http\Controllers\Invokeables\PasanganUsiaSubur;
use App\Http\Controllers\KeluargaBerencana\MonthlyReport;
use App\Http\Controllers\KeluargaBerencanaController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PregnancyController;
use App\Http\Controllers\PrenatalClassController;
use App\Http\Controllers\PuerperalClassController;
use App\Http\Controllers\PuerperalController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/role-permission', function () {
//     $role = Role::findById(2);
//     $role->givePermissionTo(['manage kader']);
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);    
    Route::resource('people', PersonController::class);
    Route::resource('families', FamilyController::class);
    Route::resource('couples', CoupleController::class);
    Route::resource('keluarga-berencana', KeluargaBerencanaController::class);
    Route::resource('pregnancies', PregnancyController::class);

    // Route halaman input laporan bulanan kesehatan ibu hamil
    Route::get('/pregnancies/{pregnancy}/prenatal-classes/{month}/create', [PrenatalClassController::class, 'create']);
    // Route store laporan bulanan kesehatan ibu hamil
    Route::post('/pregnancies/{pregnancy}/prenatal-classes', [PrenatalClassController::class, 'store']);
    // route untuk menuju halaman input edit laporan kesehatan ibu hamil
    Route::get('/prenatal-classes/{prenatalClass}/edit', [PrenatalClassController::class, 'edit']);
    // route untuk update data laporan kkesehatan ibu hamil
    Route::put('/prenatal-classes/{prenatalClass}', [PrenatalClassController::class, 'update']);


    // route untuk melihat data pelayanan nifas
    Route::get('/puerperals/{puerperal}', [PuerperalController::class, 'show']);
    // Route untuk menuju halaman input kesimpulan ibu nifas
    Route::get('/puerperals/{puerperal}/edit', [PuerperalController::class, 'edit']);
    // route untuk update kesimpulan puerperals
    Route::put('/puerperals/{puerperal}', [PuerperalController::class, 'update']);
    // route untuk menuju halaman input baru laporan kunjungan ibu nifas
    Route::get('/puerperals/{puerperal}/puerperal-classes/{periode}/create', [PuerperalClassController::class, 'create']);
    // route untuk menyimpan input laporan kunjungan ibu nifas
    Route::post('/puerperals/{puerperal}/puerperal-classes', [PuerperalClassController::class, 'store']);
    
    # INVOKEABLES #
    // route untuk menambahkan anggota baru pada sebuah keluarga, invokable
    Route::patch('/families/{family}/people/', FamilyMemberStore::class);

    // menghapus person dari keanggotaan sebuah keluarga
    Route::delete('/families/{family}/people/{person}/delete', FamilyMemberDelete::class);

    // route untuk set orang meninggal atau hidup
    Route::patch('/people/{person}/dead', DeadPerson::class);

    // route untuk menampilkan pasangan usia subur
    Route::get('/pasangan-usia-subur', PasanganUsiaSubur::class);

    # INVOKEABLES #

    // route untuk menampilkan semua list pasangan dan status KB mereka
    // Route::get('keluarga-berencana', [KeluargaBerencanaController::class, 'index'])->name('keluarga-berencana.index');
    // route untuk menyimpan atau mengupdate laporan bulanan sebuah pasangan
    Route::post('/couples/{couple}/keluarga-berencana', [KeluargaBerencanaController::class, 'store']);

    // route untuk menuju halaman buat data kehamilan baru seorang individu ibu yang punya pasangan
    // Route::get('people/{person}/pregnancies/create', [PregnancyController::class, 'create']);
    // route untuk store data kehamilan baru
    Route::post('/people/{person}/pregnancies', [PregnancyController::class, 'store']);
    // untuk menampilkan detil data kehamilan dan kelahiran
    // Route::get('/pregnancies/{pregnancy}', [PregnancyController::class, 'show']);

    // route untuk membuat atau merubah data laporan kelas ibu hamil seorang ibu
    // Route::post('/pregnancies/{pregnancy}/prenatal-class', [PrenatalClassController::class, 'store']);

    // Route::patch('pregnancies/{pregnancy}', [PregnancyController::class, 'update']);

    // controller untuk menyimpan laporan kb bulanan
    Route::post('/kb-report/{couple}', MonthlyReport::class);
    // controller untuk menyimpan data pemeriksaan kehamilan baru
    // Route::patch('/new-pregnancy/{pregnancy?}', StoreNewPregnancy::class); // pakai patch karena hanya sebagian
    // controller untuk menyimpan ringkasan kelahiran baru
    // Route::patch('/new-birth/{pregnancy}', StoreNewBirth::class); // pakai patch karena hanya sebagian
});


require __DIR__.'/auth.php';
