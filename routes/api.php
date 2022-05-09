<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;


Route::get('/ping', function () {
    return ['pong' => true];
});

Route::get('/401', [AuthController::class, 'unauthorized'])->name('login', 'loginAdmin');

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/loginAdmin', [AuthController::class, 'loginAdmin']);
Route::post('/auth/logout', [AuthController::class, 'logout']);
Route::post('/auth/refresh', [AuthController::class, 'refresh']);

Route::post('/user', [AuthController::class, 'create']);
Route::post('/userAdmin', [AuthController::class, 'createAdmin']);
Route::get('/user', [UserController::class, 'read']);

Route::get('/user/favorites', [UserController::class, 'getFavorites']);
Route::post('/user/favorite', [UserController::class, 'toggleFavorite']);
Route::get('/user/appointments', [UserController::class, 'getAppointments']);


Route::get('/doctor/getPacientes', [DoctorController::class, 'getPacientes']);
Route::get('/doctor/getAdmins', [DoctorController::class, 'getAdmins']);

Route::get('/doctors', [DoctorController::class, 'list']);
Route::get('/doctor/{id}', [DoctorController::class, 'one']);

Route::post('/doctor/{id}/appointment', [DoctorController::class, 'setAppointment']);
Route::post('/doctor/filterAppointments', [DoctorController::class, 'filterAppointments']);
Route::post('/doctor/filterAppointmentsDate', [DoctorController::class, 'filterAppointmentsDate']);
Route::delete('/doctor/appointments/{id}', [DoctorController::class, 'deleteAppointment']);

Route::post('/doctor/addService', [DoctorController::class, 'addService']);
Route::put('/doctor/updateService/{id}', [DoctorController::class, 'updateService']);


Route::post('/doctor/addHorario', [DoctorController::class, 'addHorario']);
Route::put('/doctor/updateHorario/{id}', [DoctorController::class, 'updateHorario']);

Route::get('/searchService', [DoctorController::class, 'searchService']);

