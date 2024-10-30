<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryResourceRequest;
use App\Http\Requests\UpdateCategoryResourceRequest;
use App\Models\CategoryResource;
use App\Services\CategoryResourceService;

class CategoryResourceController extends Controller
{
    private CategoryResourceService $categoryResourceService;

    public function __construct(CategoryResourceService $categoryResourceService)
    {
        $this->categoryResourceService = $categoryResourceService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paginate = request('paginate', 0);
        $relations = request('relations', []);
        $categories = $this->categoryResourceService->index($paginate, $relations);

        return view('admin.category_resources.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryResourceRequest $request)
    {
        $this->categoryResourceService->store($request->validated());

        return to_route('admin.category_resources.index')->with('success', 'Category created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryResourceRequest $request, CategoryResource $categoryResource)
    {
        $this->categoryResourceService->update($categoryResource, $request->validated());

        return to_route('admin.category_resources.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryResource $categoryResource)
    {
        $this->categoryResourceService->destroy($categoryResource);

        return to_route('admin.category_resources.index')->with('success', 'Category deleted successfully.');
    }
}
