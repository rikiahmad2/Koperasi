<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PegawaiController;

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
Route::get('/admin-manage-pembiayaan', [AdminController::class, 'managePembiayaan'])->name('admin.managePembiayaan');
Route::get('/admin-manage-pembayaran', [AdminController::class, 'managePembayaran'])->name('admin.managePembayaran');

//MANAGER
Route::get('/manager-dashboard', [ManagerController::class, 'index'])->name('manager.index');
Route::get('/manager-manage-akun', [ManagerController::class, 'manageAkun'])->name('manager.manageAkun');
Route::get('/manager-manage-nasabah', [ManagerController::class, 'manageNasabah'])->name('manager.manageNasabah');
Route::get('/manager-manage-nasabah', [ManagerController::class, 'manageNasabah'])->name('manager.manageNasabah');
Route::get('/manager-manage-pembiayaan', [ManagerController::class, 'managePembiayaan'])->name('manager.managePembiayaan');
Route::get('/manager-manage-pembayaran', [ManagerController::class, 'managePembayaran'])->name('manager.managePembayaran');

//Pegawai
Route::get('/pegawai-dashboard', [PegawaiController::class, 'index'])->name('pegawai.index');
Route::get('/pegawai-manage-nasabah', [PegawaiController::class, 'manageNasabah'])->name('pegawai.manageNasabah');
Route::get('/pegawai-manage-nasabah', [PegawaiController::class, 'manageNasabah'])->name('pegawai.manageNasabah');
Route::get('/pegawai-manage-pembiayaan', [PegawaiController::class, 'managePembiayaan'])->name('pegawai.managePembiayaan');
Route::get('/pegawai-manage-pembayaran', [PegawaiController::class, 'managePembayaran'])->name('pegawai.managePembayaran');

//CRUD AKUN
Route::post('/tambah-akun', [AdminController::class, 'tambahAkun'])->name('admin.tambahAkun');
Route::post('/edit-akun', [AdminController::class, 'editAkun'])->name('admin.editAkun');
Route::get('/delete-akun/{id}', [AdminController::class, 'deleteAkun'])->name('admin.deleteAkun');

//CRUD Nasabah
Route::post('/tambah-nasabah', [AdminController::class, 'tambahNasabah'])->name('admin.tambahNasabah');
Route::post('/edit-nasabah', [AdminController::class, 'editNasabah'])->name('admin.editNasabah');
Route::get('/delete-nasabah/{id}', [AdminController::class, 'deleteNasabah'])->name('admin.deleteNasabah');

//CRUD AKUN
Route::post('/tambah-pembiayan', [AdminController::class, 'tambahPembiayaan'])->name('admin.tambahPembiayaan');
Route::post('/edit-pembiayan', [AdminController::class, 'editPembiayaan'])->name('admin.editPembiayaan');
Route::get('/delete-pembiayan/{id}', [AdminController::class, 'deletePembiayaan'])->name('admin.deletePembiayaan');

//CRUD Pembayaran
Route::post('/tambah-pembayaran', [AdminController::class, 'tambahPembayaran'])->name('admin.tambahPembayaran');
Route::post('/edit-pembayaran', [AdminController::class, 'editPembayaran'])->name('admin.editPembayaran');
Route::get('/delete-pembayaran/{id}/{id_pembiayaan}', [AdminController::class, 'deletePembayaran'])->name('admin.deletePembayaran');
Route::get('/view-pembayaran/{id}', [AdminController::class, 'viewPembayaran'])->name('admin.viewPembayaran');

