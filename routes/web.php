<?php

use App\Enums\Roles;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\StadiumController;
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

Route::get('/stadiums', [StadiumController::class, 'index'])->name('stadiums');
Route::get('/stadium/{stadium}', [StadiumController::class, 'stadium'])->name('stadium');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/users', [\App\Http\Controllers\UserController::class, 'index'])->middleware('role:' . Roles::Admin->name)->name('users');
    Route::get('/admin/edituser/{user}', [\App\Http\Controllers\UserController::class, 'edit'])->middleware('role:' . Roles::Admin->name)->name('user.edit');
    Route::post('/admin/edituser/{user}', [\App\Http\Controllers\UserController::class, 'EditUserRequest'])->middleware('role:' . Roles::Admin->name)->name('EditUser');
    Route::get('/admin/deleteuser/{user}', [\App\Http\Controllers\UserController::class, 'DeleteUser'])->middleware('role:' . Roles::Admin->name)->name('DeleteUser');

    // teams
    Route::get('/admin/teams', [TeamController::class, 'index'])->middleware('role:' . Roles::Admin->name)->name('teams');
    Route::get('/admin/team/add', [TeamController::class, 'add'])->middleware('role:' . Roles::Admin->name)->name('team.add');
    Route::get('/admin/team/edit/{team}', [TeamController::class, 'edit'])->middleware('role:' . Roles::Admin->name)->name('team.edit');
    Route::post('admin/team/add', [TeamController::class, 'addPost'])->middleware('role:' . Roles::Admin->name)->name('team.add-post');
    Route::post('/admin/team/update', [TeamController::class, 'update'])->middleware('role:' . Roles::Admin->name)->name('team.update');
    Route::delete('/admin/team/delete', [TeamController::class, 'destroy'])->middleware('role:' . Roles::Admin->name)->name('team.destroy');
});

// Admin middleware //
Route::middleware('admin')->group(function () {
    Route::get('/admin/stadiums', [StadiumController::class, 'adminIndex'])->name('admin.stadiums');
    Route::get('/admin/stadium/add', [StadiumController::class, 'add'])->name('stadium.add');
    Route::get('/admin/stadium/edit/{stadium}', [StadiumController::class, 'edit'])->name('stadium.edit');

    Route::post('/admin/stadium/add', [StadiumController::class, 'store']);
    Route::post('/admin/stadium/edit/{team}', [StadiumController::class, 'update']);

    Route::delete('admin/stadium/delete', [StadiumController::class, 'destroy'])->name('stadium.destroy');
});


require __DIR__.'/auth.php';
