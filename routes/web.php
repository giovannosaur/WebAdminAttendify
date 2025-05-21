<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

use App\Http\Controllers\EmployeeController;

use App\Http\Controllers\TesFirestoreController;

//Route::get('/tes-firestore', [TesFirestoreController::class, 'simpanDataKeFirestore']);

Route::get('/form-kirim', function () {
    return view('kirim');
});

Route::post('/kirim', [UserController::class, 'store']);

// dashboard utama
Route::get('/', function () {
    return view('home');
});

// halaman lainnya
Route::get('/employee-management', function () {
    return view('employee-management');
});

// Employee Management Routes
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');



Route::get('/attendance', function () {
    return view('attendance');
});

Route::get('/leave-requests', function () {
    return view('leave-requests');
});

Route::get('/payroll', function () {
    return view('payroll');
});

Route::get('/overtime', function () {
    return view('overtime');
});

Route::get('/feedback', function () {
    return view('feedback');
});

Route::get('/roles', function () {
    return view('roles');
});

Route::get('/schedule', function () {
    return view('schedule');
});
