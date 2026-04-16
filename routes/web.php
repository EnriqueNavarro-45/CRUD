<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CareerController; 

Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
Route::get('/careers', [CareerController::class, 'index'])->name('careers.index');
Route::get('/careers/create', [CareerController::class, 'create'])->name('careers.create');
Route::post('/careers', [CareerController::class, 'store'])->name('careers.store');
Route::get('/careers', [CareerController::class, 'index'])->name('careers.index');
Route::get('/careers/create', [CareerController::class, 'create'])->name('careers.create');
Route::post('/careers', [CareerController::class, 'store'])->name('careers.store');
Route::get('/careers/{career}/edit', [CareerController::class, 'edit'])->name('careers.edit');
Route::put('/careers/{career}', [CareerController::class, 'update'])->name('careers.update');
Route::delete('/careers/{career}', [CareerController::class, 'destroy'])->name('careers.destroy');
Route::redirect('/', '/students');