<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AdminPagesController;
use App\Http\Controllers\ModeratorController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->group(function () {
    Route::prefix("admin")->name("admin.")->controller(AdminPagesController::class)->group(function () {
        Route::get("dashboard", "dashboard")->name("dashboard");

        Route::resource('administrators', AdministratorController::class);
        Route::resource('moderators', ModeratorController::class);
    });
});
