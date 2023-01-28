<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DeviceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;

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


// Home
Route::get('dashboard', [HomeController::class, 'index'])->name('home')->middleware('authToken');

// Login routes
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'cek'])->name('login.cek');

// Logout route
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// Info Device
Route::get('info/{deviceName}', [InfoController::class, 'info'])->name('info')->middleware('authToken');
Route::get('chart/{deviceName}', [InfoController::class, 'chart'])->name('chart')->middleware('authToken');
Route::post('edit/{deviceName}', [InfoController::class, 'edit'])->name('edit')->middleware('authToken');
Route::post('kalibrasi/{deviceName}', [InfoController::class, 'kalibrasi'])->name('kalibrasi')->middleware('authToken');

// Download CSV
Route::get('csv/{deviceName}', [InfoController::class, 'csv'])->name('csv')->middleware('authToken');

// Device List
Route::get('device', [DeviceController::class, 'index'])->name('device')->middleware('authToken');
Route::get('infolist/{deviceNameList}', [InfoController::class, 'info'])->name('infolist')->middleware('authToken');

// User Management
Route::get('admin', [AdminController::class, 'index'])->name('admin')->middleware('authToken');
Route::post('create', [AdminController::class, 'create'])->name('admin.create');
Route::post('editview/{id}', [AdminController::class, 'editUser'])->name('admin.edit');
Route::post('hapus/{id}', [AdminController::class, 'hapus'])->name('admin.delete');
Route::post('pass/{id}', [AdminController::class, 'changePass'])->name('admin.pass');
