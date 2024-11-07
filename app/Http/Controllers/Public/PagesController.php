<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\University;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $universities = University::latest()->get();
        $moreResourcesDownload = Resource::latest()->limit(10)->get();

        return view(
            'public.pages.home',
            compact('universities', 'moreResourcesDownload')
        );
    }
}
