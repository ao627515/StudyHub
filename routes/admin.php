<?php

use App\Http\Controllers\AcademicLevelController;
use App\Http\Controllers\AcademicProgramController;
use App\Http\Controllers\AcademicProgramLevelController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AdminPagesController;
use App\Http\Controllers\CategoryResourceController;
use App\Http\Controllers\CourseModuleController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\UploaderController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->group(function () {
    Route::prefix("admin")->name("admin.")->controller(AdminPagesController::class)->group(function () {
        Route::get("dashboard", "dashboard")->name("dashboard");
        // Route::get("profile", "profile")->name("profile");
        Route::get("users/profile", [ProfileController::class, 'show'])->name('profile.show');
        Route::put("users/profile", [ProfileController::class, 'update'])->name('profile.update');

        Route::resource('administrators', AdministratorController::class);
        Route::resource('moderators', ModeratorController::class);
        Route::resource('uploaders', UploaderController::class);
        Route::resource('universities', UniversityController::class)->except(['edit', 'create', 'show']);
        Route::resource('academic_programs', AcademicProgramController::class)->except(['edit', 'create', 'show']);
        Route::resource("teachers", TeacherController::class)->except(['create', 'show', 'edit']);
        Route::resource("academic_levels", AcademicLevelController::class)->except(['create', 'show', 'edit']);
        Route::resource("course_modules", CourseModuleController::class)->except(['create', 'show', 'edit']);
        Route::resource("resources", ResourceController::class);
        Route::resource("category_resources", CategoryResourceController::class)->except(['create', 'show', 'edit']);
        Route::resource("academic_program_levels", AcademicProgramLevelController::class)->except(['create', 'show', 'edit']);
    });
});
