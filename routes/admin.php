<?php

use App\Http\Controllers\AcademicProgramController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AdminPagesController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\UploderController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->group(function () {
    Route::prefix("admin")->name("admin.")->controller(AdminPagesController::class)->group(function () {
        Route::get("dashboard", "dashboard")->name("dashboard");

        Route::resource('administrators', AdministratorController::class);
        Route::resource('moderators', ModeratorController::class);
        Route::resource('uploders', UploderController::class);
        Route::resource('universities', UniversityController::class);
        Route::resource('academic_programs', AcademicProgramController::class);
    });
});
