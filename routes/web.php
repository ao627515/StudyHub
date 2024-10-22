<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', 'admin/dashboard', 301);

require __DIR__ . '/admin.php';
require __DIR__ . '/admin_auth.php';
