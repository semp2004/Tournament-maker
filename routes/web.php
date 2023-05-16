<?php

use App\Enums\Roles;
use App\Http\Controllers\ProfileController;
use Couchbase\Role;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/users', [\App\Http\Controllers\UserController::class, 'index'])->middleware('role:' . Roles::Admin->name)->name('users');
    Route::get('/admin/edituser/{user}', [\App\Http\Controllers\UserController::class, 'edit'])->middleware('role:' . Roles::Admin->name)->name('user.edit');
    Route::post('/admin/edituser/{user}', [\App\Http\Controllers\UserController::class, 'EditUserRequest'])->middleware('role:' . Roles::Admin->name)->name('EditUser');
    Route::get('/admin/deleteuser/{user}', [\App\Http\Controllers\UserController::class, 'DeleteUser'])->middleware('role:' . Roles::Admin->name)->name('DeleteUser');

});


require __DIR__.'/auth.php';
