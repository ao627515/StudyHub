<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AcademicLevel;
use App\Models\AcademicProgram;
use App\Models\CategoryResource;
use App\Models\CourseModule;
use App\Models\Resource;
use App\Models\University;
use App\Services\ResourceService;
use App\Services\SeoService;

class PagesController extends Controller
{
    private ResourceService $resourceService;
    private SeoService $seoService;

    public function __construct(ResourceService $resourceService, SeoService $seoService)
    {
        $this->resourceService = $resourceService;
        $this->seoService = $seoService;
    }

    public function home()
    {
        // SEO configuration for the home page
        $this->seoService->setPageSeo(
            title: 'StudyHub - Partage de Ressources Académiques',
            description: 'Découvrez StudyHub, la plateforme qui centralise les ressources académiques de diverses institutions. Recherchez, partagez et accédez aux ressources éducatives dont vous avez besoin pour vos études.',
            canonical: route('public.pages.home'),
            keywords: ['ressources académiques', 'partage de cours', 'StudyHub', 'étudiants', 'universités'],
            image: asset('assets/global/svg/logo.svg') // Assurez-vous d'avoir une image pour la page d'accueil
        );

        $universities = University::latest()->get(['id', 'name', 'logo']);
        $moreResourcesDownload = Resource::latest()->limit(6)->get();
        $levels = AcademicLevel::all(['id', 'name']);
        $resourceCategories = CategoryResource::latest()->get(['id', 'name']);
        $programs = AcademicProgram::all(['id', 'name']);

        return view(
            'public.pages.home',
            compact(
                'universities',
                'moreResourcesDownload',
                'levels',
                'resourceCategories',
                'programs'
            )
        );
    }

    public function searchAdvance()
    {
        // SEO configuration for the searchAdvance page
        $this->seoService->setPageSeo(
            title: 'Recherche Avancée - Trouvez des Ressources Académiques sur StudyHub',
            description: 'Utilisez notre fonctionnalité de recherche avancée pour filtrer et trouver les ressources académiques parfaites. Affinez votre recherche par université, programme, niveau académique et année scolaire.',
            canonical: route('public.resources.seachAdvance'),
            keywords: ['recherche avancée', 'ressources académiques', 'StudyHub', 'filtres de recherche', 'cours et documents'],
            image: asset('assets/global/svg/logo.svg') // Image pour la page de recherche avancée
        );

        $universities = University::latest()->get(['id', 'name']);
        $levels = AcademicLevel::all(['id', 'name']);
        $schoolYears = Resource::distinct()->pluck('school_year');
        $programs = AcademicProgram::all(['id', 'name']);
        $modules = CourseModule::all(['id', 'name']);
        $resourceCategories = CategoryResource::latest()->get(['id', 'name']);

        $params = [
            'paginate' => request('paginate', 0),
            'relations' => request('relations', []),
            'university' => request('university', 0),
            'program' => request('program', 0),
            'level' => request('level', 0),
            'category' => request('category', 0),
            'name' => request('name', ''),
            'module' => request('module', 0),
            'schoolYear' => request('schoolYear', 0),
            'limit' => 0,
            'layout' => request('layout', null)
        ];
        $resources = $this->resourceService->index($params);
        return view(
            'public.pages.search_advance',
            compact(
                'universities',
                'levels',
                'resourceCategories',
                'resources',
                'schoolYears',
                'programs',
                'modules',
                'params'
            )
        );
    }
}
