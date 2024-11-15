<?php

use App\Models\Resource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\Public\PagesController;

//
// Route::get('home',  function () {
//     return view('public.pages.home');
// });


Route::name('public.')->group(callback: function () {
    Route::get('home', [PagesController::class, 'home'])->name('pages.home');
    Route::get('resource/{resource}/download', [ResourceController::class, 'downloadFile'])->name('resource.download');
    Route::get('resource/seach-advance', [PagesController::class, 'searchAdvance'])->name('resources.seachAdvance');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
});
