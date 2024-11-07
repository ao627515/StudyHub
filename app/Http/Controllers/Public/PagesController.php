<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $universities = University::latest()->get();

        return view(
            'public.pages.home',
            compact('universities')
        );
    }
}
