<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CategoryTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\CategoryService;
use App\Services\FileService;
use Illuminate\View\View; // Használjuk a View típus-hintet

class CategoryController extends Controller
{
    private CategoryService $categoryService;
    private FileService $fileService;

    public function __construct(CategoryService $categoryService, FileService $fileService)
    {
        $this->categoryService = $categoryService;
        $this->fileService = $fileService;
    }

    public function index(): View
    {
        $data = $this->prepareFormData();
        $data['category'] = new Category();

        return view('admin.categories.index', $data);
    }

    public function edit(Category $category): View
    {
        $data = $this->prepareFormData();
        $data['category'] = $category;

        return view('admin.categories.index', $data);
    }

    public function store(CategoryStoreRequest $request)
    {
        $category = $this->categoryService->create($request->validated());

        $this->handleThumbnailUpload($category, $request->file('thumbnail'));

        return redirect()->route('admin.categories.index');
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category = $this->categoryService->update($category, $request->validated());

        $this->handleThumbnailUpload($category, $request->file('thumbnail'));

        return redirect()->route('admin.categories.index');
    }

    public function destroy(Category $category)
    {
        $this->categoryService->delete($category);

        return redirect()->route('admin.categories.index');
    }

    private function prepareFormData(): array
    {
        return [
            'categories' => Category::all()->pluck('name', 'id'),
            'categoryTypes' => CategoryTypeEnum::labels(),
        ];
    }

    private function handleThumbnailUpload(Category $category, $file): void
    {
        $this->fileService->upload($category, $file, 'thumbnail');
    }
}
