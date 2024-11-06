<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', 'home', 301);

require __DIR__ . '/admin.php';
require __DIR__ . '/public.php';
require __DIR__ . '/admin_auth.php';
