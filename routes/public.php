<?php

use Illuminate\Support\Facades\Route;


Route::get('home',  function () {
    return view('public.pages.home');
});
