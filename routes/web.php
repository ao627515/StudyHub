<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.pages.dashboard');
});

require __DIR__ . '/admin.php';
require __DIR__ . '/admin_auth.php';
