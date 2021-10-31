<?php

use App\Http\Controllers\AnthropometryController;
use Illuminate\Http\Request;

use App\Http\Controllers\ChildbirthController;
use App\Http\Controllers\CoupleController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\Invokeables\DeadPerson;
use App\Http\Controllers\Invokeables\FamilyMemberDelete;
use App\Http\Controllers\Invokeables\FamilyMemberStore;
use App\Http\Controllers\Invokeables\PasanganUsiaSubur;
use App\Http\Controllers\KeluargaBerencana\MonthlyReport;
use App\Http\Controllers\KeluargaBerencanaController;
use App\Http\Controllers\NeonatusController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PersonFamilyController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\PosyanduServiceController;
use App\Http\Controllers\PregnancyController;
use App\Http\Controllers\PrenatalClassController;
use App\Http\Controllers\PuerperalClassController;
use App\Http\Controllers\PuerperalController;
use App\Http\Controllers\ToddlerMeasurementController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// route untuk uji coba template
Route::view('/dashboard-template', 'template.index');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // REFACTORING

    # Route ini akan menampilkan tabel data semua warga desa kedungpuji
    Route::get('/people', [PersonController::class, 'index'])->name('people.index');
    # untuk menampilkan warga yang pindah atau mati
    Route::view('/people/move-or-die', 'people.hidden-people-table')->name('people.index.hidden'); 
    # rount untuk menampilkan halaman input warga baru
    Route::get('/people/create', [PersonController::class, 'create'])->name('people.create');
    # Route untuk menyimpan request input ke database
    Route::post('/people', [PersonController::class, 'store'])->name('people.store');
    # show data individu penduduk
    Route::get('/people/{person}', [PersonController::class, 'show'])->name('people.show');
    # menuju halaman edit data penduduk
    Route::get('/people/{person}/edit', [PersonController::class, 'edit'])->name('people.edit');
    # Route update data penduduk
    Route::put('/people/{person}', [PersonController::class, 'update'])->name('people.update');


    // Route untuk menampilkan semua keluarga di desa kedungpuji
    Route::get('/families', [FamilyController::class, 'index'])->name('families.index');
    // Route untuk menampilkan halaman form buat keluarga
    Route::get('/families/create', [FamilyController::class, 'create'])->name('families.create');
    // menyimpan data input form buat keluarga ke database
    Route::post('/families', [FamilyController::class, 'store'])->name('families.store');
    // menampilkan data detail family
    Route::get('/families/{family}', [FamilyController::class, 'show'])->name('families.show');
    // menuju halaman edit keluarga
    Route::get('/families/{family}/edit', [FamilyController::class, 'edit'])->name('families.edit');
    // update ke dalam database
    Route::put('/families/{family}', [FamilyController::class, 'update'])->name('families.update');
    // hapus keluarga supaya
    Route::delete('/families/{family}', [FamilyController::class, 'destroy'])->name('families.destroy');


    // Route untuk menambahkan anggota pada sebuat keluarga
    Route::post('/families/{family}/people', [PersonFamilyController::class, 'store']);
    // menghapus person dari keanggotaan sebuah keluarga
    Route::delete('/families/{family}/people/{person}/delete', [PersonFamilyController::class, 'destroy']);


    // menampilkan semua pasangan yang ada
    Route::get('/couples', [CoupleController::class, 'index'])->name('couples.index');
    // menampilkan halaman form tambah pasangan
    Route::get('/couples/create', [CoupleController::class, 'create'])->name('couples.create');
    // store ke database data pasangan pada create veiw
    Route::post('/couples', [CoupleController::class, 'store'])->name('couples.store');
    // menampilkan data sebuah pasangan
    Route::get('/couples/{couple}', [CoupleController::class, 'show'])->name('couples.show');
    // menampilkan halaman form edit pasangan
    Route::get('/couples/{couple}/edit', [CoupleController::class, 'edit'])->name('couples.edit');
    // route menyimpan input dari halaman edit
    Route::put('/couples/{couple}', [CoupleController::class, 'update'])->name('couples.update');
    // hapus atau cerai pasangan
    Route::delete('/couples/{couple}', [CoupleController::class, 'destroy'])->name('couples.destroy');


    // route untuk menampilkan semua list pasangan dan status KB mereka
    Route::get('/keluarga-berencana', [KeluargaBerencanaController::class, 'index']);
    //menyimpan data laporan kb bulanan per pasangan
    Route::post('/couples/{couple}/keluarga-berencana', [KeluargaBerencanaController::class, 'store']);


    Route::resource('pregnancies', PregnancyController::class);


    // Route halaman input laporan bulanan kesehatan ibu hamil
    Route::get('/pregnancies/{pregnancy}/prenatal-classes/{month}/create', [PrenatalClassController::class, 'create']);

    // END REFACTORING


    Route::resource('users', UserController::class);    


    Route::get('/childbirths', [ChildbirthController::class, 'index'])->name('childbirths.index');
    Route::get('/childbirths/{pregnancy}/create', [ChildbirthController::class, 'create']);
    Route::post('/childbirths/{pregnancy}', [ChildbirthController::class, 'store']);


    
    // Route store laporan bulanan kesehatan ibu hamil
    Route::post('/pregnancies/{pregnancy}/prenatal-classes', [PrenatalClassController::class, 'store']);
    // route untuk menuju halaman input edit laporan kesehatan ibu hamil
    Route::get('/prenatal-classes/{prenatalClass}/edit', [PrenatalClassController::class, 'edit']);
    // route untuk update data laporan kkesehatan ibu hamil
    Route::put('/prenatal-classes/{prenatalClass}', [PrenatalClassController::class, 'update']);


    // Route untuk menampilkan list ibu nifas
    Route::get('/puerperals', [PuerperalController::class, 'index']);
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
    // route untuk menunju halaman edit puerperal


    // Route untuk melihat semua laporan neonatuses
    Route::get('/people/{person}/neonatuses', [NeonatusController::class, 'index']);
    // Route untuk menuju halaman form simpan data pelayanan neonatus
    Route::get('/posyandu/{posyandu}/neonatuses/{periode}/create', [NeonatusController::class, 'create']);
    // route menyimpan laporan neonatus
    Route::post('/posyandu/{posyandu}/neonatuses', [NeonatusController::class, 'store']);
    // route menuju halaman edit input pelayanan neonatus
    Route::get('/neonatuses/{neonatus}/edit', [NeonatusController::class, 'edit']);
    // route untuk update pelayanan neonatus
    Route::put('/neonatuses/{neonatus}', [NeonatusController::class, 'update']);


    // route untuk indeks posyandu balita
    Route::get('/posyandu', [PosyanduController::class, 'index']);
    // route untuk menambahkan orang atau balita ke dalam posyandu
    Route::get('/posyandu/create', [PosyanduController::class, 'create']);
    // route untuk store input pendaftaran posyandu
    Route::post('/people/{person}/posyandu', [PosyanduController::class, 'store']);
    // Route untuk show data posyandu
    Route::get('/posyandu/{posyandu}', [PosyanduController::class, 'show']);


    // menampilkan tabel layanan pengukuran seorang bayi
    Route::get('/posyandu/{posyandu}/anthropometries', [AnthropometryController::class, 'index']);
    // menuju halaman input laporan antropometries bulanan
    Route::get('/posyandu/{posyandu}/age-in-month/{month}/anthropometries/create', [AnthropometryController::class, 'create']);
    // store input laporan bulanan
    Route::post('/posyandu/{posyandu}/age-in-month/{month}/anthropometries', [AnthropometryController::class, 'store']);
    // route untuk menuju halaman edit
    Route::get('/anthropometries/{anthropometry}/edit', [AnthropometryController::class, 'edit']);
    // update anthropometry data dari hhalaman edit
    Route::put('/anthropometries/{anthropometry}', [AnthropometryController::class, 'update']);
    

    
    # INVOKEABLES #
    

    // route untuk menampilkan pasangan usia subur
    Route::get('/pasangan-usia-subur', PasanganUsiaSubur::class);
    # INVOKEABLES #

        // route untuk menyimpan atau mengupdate laporan bulanan sebuah pasangan

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

// Route::view('/imports', 'imports');

// // route untuk import table
// Route::post('/import-excel/import', function (Request $request){
//     Excel::import(new HeightForAgeGirlsImport, $request->file_excel);
//     return redirect('/imports');
// });


require __DIR__.'/auth.php';
