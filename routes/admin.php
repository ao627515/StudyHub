<?php

use App\Http\Controllers\AdminPagesController;
use Illuminate\Support\Facades\Route;

Route::prefix("admin")->name("admin.")->controller(AdminPagesController::class)->group(function () {
    Route::get("dashboard", "dashboard")->name("dashboard");
});
