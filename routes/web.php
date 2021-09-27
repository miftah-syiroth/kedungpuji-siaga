<?php

use App\Http\Controllers\CoupleController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
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
});


require __DIR__.'/auth.php';
