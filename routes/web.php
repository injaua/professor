<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ClassroomController;

Route::get('/', function () {
    return view('welcome');
})->name('home');



//rota de recursos (com crud completo) para o teacher
Route::resource('teachers', TeacherController::class);
//Route::resource('classrooms', ClassroomController::class);


//Classroom
Route::get('classrooms/create', [ClassroomController::class, 'create'])->name('classrooms.create');
Route::post('classrooms', [ClassroomController::class, 'store'])->name('classrooms.store');
Route::delete('classrooms/{classroom}', [ClassroomController::class, 'destroy'])->name('classrooms.destroy');

