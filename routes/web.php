<?php

use App\Http\Controllers\AnthropometryController;
use Illuminate\Http\Request;

use App\Http\Controllers\ChildbirthController;
use App\Http\Controllers\CoupleController;
use App\Http\Controllers\Deleted\DeleteCoupleController;
use App\Http\Controllers\Deleted\DeleteFamilyController;
use App\Http\Controllers\Deleted\DeletePersonController;
use App\Http\Controllers\Deleted\DeletePosyanduController;
use App\Http\Controllers\Deleted\DeletePregnancyController;
use App\Http\Controllers\Deleted\DeletePuerperalController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\Invokables\DiedMovedPeople;
use App\Http\Controllers\Invokables\IbuHamil;
use App\Http\Controllers\Invokables\IbuNifas;
use App\Http\Controllers\KeluargaBerencanaController;
use App\Http\Controllers\NeonatusController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PersonFamilyController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\PregnancyController;
use App\Http\Controllers\PrenatalClassController;
use App\Http\Controllers\PuerperalClassController;
use App\Http\Controllers\PuerperalController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// route untuk uji coba template
Route::view('/dashboard-template', 'template.index');


Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // REFACTORING
    #kalau bisa panjang, knp harus pendek pakai resource hahaha

    # Route ini akan menampilkan tabel data semua warga desa kedungpuji
    Route::get('/people', [PersonController::class, 'index'])->name('people.index');
    # untuk menampilkan warga yang pindah atau mati INVOKEABLES
    Route::get('/people/move-or-die', DiedMovedPeople::class)->name('people.dead');
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
    #route hapus person secara soft
    Route::delete('/people/{person}', [PersonController::class, 'destroy'])->name('people.destroy');


    // childbirth ini kmrn aku passing ke view utk menambah penduduk berdasarkan kelahiran
    Route::get('/childbirths', [ChildbirthController::class, 'index'])->name('people.childbirths.index');
    Route::get('/pregnancies/{pregnancy}/childbirths/create', [ChildbirthController::class, 'create'])->name('people.childbirths.create');
    Route::post('/pregnancies/{pregnancy}/childbirths', [ChildbirthController::class, 'store'])->name('people.childbirths.store');


    // Route untuk menampilkan semua keluarga di desa kedungpuji
    Route::get('/families', [FamilyController::class, 'index'])->name('kb.families.index');
    // Route untuk menampilkan halaman form buat keluarga
    Route::get('/families/create', [FamilyController::class, 'create'])->name('kb.families.create');
    // menyimpan data input form buat keluarga ke database
    Route::post('/families', [FamilyController::class, 'store'])->name('families.store');
    // menampilkan data detail family
    Route::get('/families/{family}', [FamilyController::class, 'show'])->name('kb.families.show');
    // menuju halaman edit keluarga
    Route::get('/families/{family}/edit', [FamilyController::class, 'edit'])->name('kb.families.edit');
    // update ke dalam database
    Route::put('/families/{family}', [FamilyController::class, 'update'])->name('families.update');
    // hapus keluarga supaya
    Route::delete('/families/{family}', [FamilyController::class, 'destroy'])->name('families.destroy');


    // Route untuk menambahkan anggota pada sebuat keluarga
    Route::post('/families/{family}/people', [PersonFamilyController::class, 'store']);
    // menghapus person dari keanggotaan sebuah keluarga
    Route::delete('/families/{family}/people/{person}/delete', [PersonFamilyController::class, 'destroy']);


    // menampilkan semua pasangan yang ada
    Route::get('/couples', [CoupleController::class, 'index'])->name('kb.couples.index');
    // menampilkan halaman form tambah pasangan
    Route::get('/couples/create', [CoupleController::class, 'create'])->name('kb.couples.create');
    // store ke database data pasangan pada create veiw
    Route::post('/couples', [CoupleController::class, 'store'])->name('couples.store');
    // menampilkan data sebuah pasangan
    Route::get('/couples/{couple}', [CoupleController::class, 'show'])->name('kb.couples.show');
    // menampilkan halaman form edit pasangan
    Route::get('/couples/{couple}/edit', [CoupleController::class, 'edit'])->name('kb.couples.edit');
    // route menyimpan input dari halaman edit
    Route::put('/couples/{couple}', [CoupleController::class, 'update'])->name('couples.update');
    // hapus atau cerai pasangan
    Route::delete('/couples/{couple}', [CoupleController::class, 'destroy'])->name('couples.destroy');


    // route untuk menampilkan semua list pasangan dan status KB mereka
    Route::get('/keluarga-berencana', [KeluargaBerencanaController::class, 'index'])->name('kb.index');
    //menyimpan data laporan kb bulanan per pasangan
    Route::post('/couples/{couple}/keluarga-berencana', [KeluargaBerencanaController::class, 'store']);


    Route::resource('pregnancies', PregnancyController::class);
    // INVOKABLE route untuk menampilkan data ibu hamil yg belum melahirkan
    Route::get('/ibu-hamil', IbuHamil::class)->name('pregnancies.ibu-hamil');
    // INVOKABLE route untuk menampilkan data ibu nifas yg belum selesai
    Route::get('/ibu-nifas', IbuNifas::class)->name('pregnancies.ibu-nifas');


    // Route halaman input laporan bulanan kesehatan ibu hamil
    Route::get('/pregnancies/{pregnancy}/month/{month}/prenatal-classes/create', [PrenatalClassController::class, 'create'])->name('pregnancies.prenatal-class.create');
    // Route store laporan bulanan kesehatan ibu hamil
    Route::post('/pregnancies/{pregnancy}/month/{month}/prenatal-classes', [PrenatalClassController::class, 'store']);
    // route untuk menuju halaman input edit laporan kesehatan ibu hamil
    Route::get('/prenatal-classes/{prenatalClass}/edit', [PrenatalClassController::class, 'edit'])->name('pregnancies.prenatal-class.edit');
    // route untuk update data laporan kkesehatan ibu hamil
    Route::put('/prenatal-classes/{prenatalClass}', [PrenatalClassController::class, 'update']);

    
    // Route untuk menampilkan list ibu nifas
    Route::get('/puerperals', [PuerperalController::class, 'index'])->name('pregnancies.puerperals.index');
    // rounte untuk simpan pembuatan objek nifas
    Route::post('/pregnancies/{pregnancy}/puerperals', [PuerperalController::class, 'store']);
    // route untuk melihat data pelayanan nifas
    Route::get('/puerperals/{puerperal}', [PuerperalController::class, 'show'])->name('pregnancies.puerperals.show');
    // Route untuk menuju halaman input kesimpulan ibu nifas
    Route::get('/puerperals/{puerperal}/edit', [PuerperalController::class, 'edit'])->name('pregnancies.puerperals.edit');
    // route untuk update kesimpulan puerperals
    Route::put('/puerperals/{puerperal}', [PuerperalController::class, 'update']);
    // route unutk soft delete puerperal
    Route::delete('/puerperals/{puerperal}', [PuerperalController::class, 'destroy']);


    // route untuk menuju halaman input baru laporan kunjungan ibu nifas
    Route::get('/puerperals/{puerperal}/periode/{periode}/puerperal-classes/create', [PuerperalClassController::class, 'create'])->name('pregnancies.puerperal_classes.create');
    // route untuk menyimpan input laporan kunjungan ibu nifas
    Route::post('/puerperals/{puerperal}/periode/{periode}/puerperal-classes', [PuerperalClassController::class, 'store']);
    // route untuk menunju halaman edit puerperal
    Route::get('/puerperal-classes/{puerperalClass}/edit', [PuerperalClassController::class, 'edit'])->name('pregnancies.puerperal_classes.edit');
    // route untuk update data input laporan ibu nifas
    Route::put('/puerperal-classes/{puerperalClass}', [PuerperalClassController::class, 'update']);


    // route untuk indeks posyandu balita
    Route::get('/posyandu', [PosyanduController::class, 'index'])->name('posyandu.index');
    // route untuk store input pendaftaran posyandu
    Route::post('/people/{person}/posyandu', [PosyanduController::class, 'store']);
    // Route untuk show data posyandu
    Route::get('/posyandu/{posyandu}', [PosyanduController::class, 'show'])->name('posyandu.show');
    // route edit posyandu
    Route::get('/posyandu/{posyandu}/edit', [PosyanduController::class, 'edit'])->name('posyandu.edit');
    // update ringkasan posyand
    Route::put('/posyandu/{posyandu}', [PosyanduController::class, 'update'])->name('posyandu.update');
    // hapus posyandu di halaman edit posyandu
    Route::delete('/posyandu/{posyandu}', [PosyanduController::class, 'destroy'])->name('posyandu.destroy');


    // Route untuk menuju halaman form simpan data pelayanan neonatus
    Route::get('/posyandu/{posyandu}/periode/{periode}/neonatuses/create', [NeonatusController::class, 'create'])->name('posyandu.neonatuses.create');
    // route menyimpan laporan neonatus
    Route::post('/posyandu/{posyandu}/periode/{periode}/neonatuses', [NeonatusController::class, 'store'])->name('posyandu.neonatuses.store');
    // route menuju halaman edit input pelayanan neonatus
    Route::get('/neonatuses/{neonatus}/edit', [NeonatusController::class, 'edit'])->name('posyandu.neonatuses.edit');
    // route untuk update pelayanan neonatus
    Route::put('/neonatuses/{neonatus}', [NeonatusController::class, 'update']);


    // menuju halaman input laporan antropometries bulanan
    Route::get('/posyandu/{posyandu}/month/{month}/anthropometries/create', [AnthropometryController::class, 'create'])->name('posyandu.anthropometries.create');
    // store input laporan bulanan
    Route::post('/posyandu/{posyandu}/month/{month}/anthropometries', [AnthropometryController::class, 'store']);
    // route untuk menuju halaman edit
    Route::get('/anthropometries/{anthropometry}/edit', [AnthropometryController::class, 'edit'])->name('posyandu.anthropometries.store');
    // update anthropometry data dari hhalaman edit
    Route::put('/anthropometries/{anthropometry}', [AnthropometryController::class, 'update']);


    Route::resource('users', UserController::class);
    
    
    #DELETE MODELS
    // menampilkan tabel posyandu yang terhapus
    Route::get('/deleted/posyandu', [DeletePosyanduController::class, 'index'])->name('deleted.posyandu.index');
    Route::patch('/deleted/posyandu/{posyandu}/restore', [DeletePosyanduController::class, 'restore']);
    Route::delete('/deleted/posyandu/{posyandu}', [DeletePosyanduController::class, 'destroy']);


    Route::get('/deleted/puerperals', [DeletePuerperalController::class, 'index'])->name('deleted.puerperals.index');
    Route::patch('/deleted/puerperals/{puerperal}/restore', [DeletePuerperalController::class, 'restore']);
    Route::delete('/deleted/puerperals/{puerperal}', [DeletePuerperalController::class, 'destroy']);

    Route::get('/deleted/pregnancies', [DeletePregnancyController::class, 'index'])->name('deleted.pregnancies.index');
    Route::patch('/deleted/pregnancies/{pregnancy}/restore', [DeletePregnancyController::class, 'restore']);
    Route::delete('/deleted/pregnancies/{pregnancy}', [DeletePregnancyController::class, 'destroy']);


    Route::get('/deleted/couples', [DeleteCoupleController::class, 'index'])->name('deleted.couples.index');
    Route::patch('/deleted/couples/{couple}/restore', [DeleteCoupleController::class, 'restore']);
    Route::delete('/deleted/couples/{couple}', [DeleteCoupleController::class, 'destroy']);


    Route::get('/deleted/families', [DeleteFamilyController::class, 'index'])->name('deleted.families.index');
    Route::patch('/deleted/families/{family}/restore', [DeleteFamilyController::class, 'restore']);
    Route::delete('/deleted/families/{family}', [DeleteFamilyController::class, 'destroy']);


    Route::get('/deleted/people', [DeletePersonController::class, 'index'])->name('deleted.people.index');
    Route::patch('/deleted/people/{person}/restore', [DeletePersonController::class, 'restore']);
    Route::delete('/deleted/people/{person}', [DeletePersonController::class, 'destroy']);

    // END REFACTORING
});

// Route::view('/imports', 'imports');

// // route untuk import table
// Route::post('/import-excel/import', function (Request $request){
//     Excel::import(new HeightForAgeGirlsImport, $request->file_excel);
//     return redirect('/imports');
// });


require __DIR__.'/auth.php';
