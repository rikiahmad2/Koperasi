<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;

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

Route::get('/', [AuthController::class, 'index'])->name('auth.index');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/postLogin', [AuthController::class, 'postLogin'])->name('auth.postLogin');

//ADMIN
Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin-manage-akun', [AdminController::class, 'manageAkun'])->name('admin.manageAkun');
Route::get('/admin-manage-nasabah', [AdminController::class, 'manageNasabah'])->name('admin.manageNasabah');

//MANAGER
Route::get('/manager-dashboard', [ManagerController::class, 'index'])->name('manager.index');
Route::get('/manager-manage-akun', [ManagerController::class, 'manageAkun'])->name('manager.manageAkun');
Route::get('/manager-manage-nasabah', [ManagerController::class, 'manageNasabah'])->name('manager.manageNasabah');

//CRUD AKUN
Route::post('/tambah-akun', [AdminController::class, 'tambahAkun'])->name('admin.tambahAkun');
Route::post('/edit-akun', [AdminController::class, 'editAkun'])->name('admin.editAkun');
Route::get('/delete-akun/{id}', [AdminController::class, 'deleteAkun'])->name('admin.deleteAkun');

//CRUD Nasabah
Route::post('/tambah-nasabah', [AdminController::class, 'tambahNasabah'])->name('admin.tambahNasabah');
Route::post('/edit-nasabah', [AdminController::class, 'editNasabah'])->name('admin.editNasabah');
Route::get('/delete-nasabah/{id}', [AdminController::class, 'deleteNasabah'])->name('admin.deleteNasabah');

