<?php

use App\Http\Controllers\Public\PagesController;
use App\Http\Controllers\ResourceController;
use App\Models\Resource;
use Illuminate\Support\Facades\Route;

//
// Route::get('home',  function () {
//     return view('public.pages.home');
// });


Route::name('public.')->group(function () {
    Route::get('home', [PagesController::class, 'home'])->name('pages.home');
    Route::get('resource/{resource}/download', [ResourceController::class, 'downloadFile'])->name('resource.download');
});
