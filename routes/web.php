<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'coordinator'])->prefix('beheer')->name('beheer.')->group(function () {
    Route::get('/incidents/{incident}/edit', [BeheerController::class, 'editIncident'])->name('incidents.edit');
    Route::patch('/incidents/{incident}', [BeheerController::class, 'updateIncident'])->name('incidents.update');
});


Route::middleware(['auth', 'beheerder'])->prefix('beheer')->name('beheer.')->group(function () {
    Route::get('/', [BeheerController::class, 'index'])->name('index');
    Route::delete('/incidents/{incident}', [BeheerController::class, 'destroyIncident'])->name('incidents.destroy');
    Route::post('/incidenttypes', [BeheerController::class, 'storeIncidentType'])->name('incidenttypes.store');
    Route::patch('/incidenttypes/{incidentType}', [BeheerController::class, 'updateIncidentType'])->name('incidenttypes.update');
    Route::delete('/incidenttypes/{incidentType}', [BeheerController::class, 'destroyIncidentType'])->name('incidenttypes.destroy');
    Route::post('/locaties', [BeheerController::class, 'storeLocation'])->name('locations.store');
    Route::patch('/locaties/{location}', [BeheerController::class, 'updateLocation'])->name('locations.update');
    Route::delete('/locaties/{location}', [BeheerController::class, 'destroyLocation'])->name('locations.destroy');
    Route::patch('/gebruikers/{user}/rol', [BeheerController::class, 'updateUserRole'])->name('users.role');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegistration'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
