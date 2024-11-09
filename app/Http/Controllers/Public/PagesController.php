<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AcademicLevel;
use App\Models\CategoryResource;
use App\Models\Resource;
use App\Models\University;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $universities = University::latest()->get(['id', 'name']);
        $moreResourcesDownload = Resource::latest()->limit(10)->get();
        $levels = AcademicLevel::all(['id', 'name']);
        $resourceCategories = CategoryResource::latest()->get(['id', 'name']);

        return view(
            'public.pages.home',
            compact(
                'universities',
                'moreResourcesDownload',
                'levels',
                'resourceCategories'
            )
        );
    }
}
