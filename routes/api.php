<?php

use App\Http\Controllers\Api\AcademicProgramController;
use App\Http\Controllers\Api\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\UniversityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware("auth:sanctum")->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::resource("universities", UniversityController::class)->except(['create', 'edit']);
    Route::resource("academic_programs", AcademicProgramController::class)->except(['create', 'show', 'edit']);
});


Route::middleware('guest')->group(function () {
    Route::get('signin', [AuthenticatedSessionController::class, 'store']);
    Route::post('signout', [AuthenticatedSessionController::class, 'destroy']);
    Route::get('auth/fail', [AuthenticatedSessionController::class, 'fail'])->name('api.auth.fail');
});
