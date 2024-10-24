<?php

use App\Http\Controllers\AcademicProgramController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AdminPagesController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\UploaderController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->group(function () {
    Route::prefix("admin")->name("admin.")->controller(AdminPagesController::class)->group(function () {
        Route::get("dashboard", "dashboard")->name("dashboard");

        Route::resource('administrators', AdministratorController::class);
        Route::resource('moderators', ModeratorController::class);
        Route::resource('uploaders', UploaderController::class);
        Route::resource('universities', UniversityController::class)->except(['edit', 'create', 'show']);
        Route::resource('academic_programs', AcademicProgramController::class)->except(['edit', 'create', 'show']);
        Route::resource("teachers", TeacherController::class)->except(['create', 'edit']);
    });
});
