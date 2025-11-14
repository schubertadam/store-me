<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CategoryTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\CategoryService;
use App\Services\FileService;

class CategoryController extends Controller
{
    private CategoryService $categoryService;
    private FileService $fileService;

    public function __construct(CategoryService $categoryService, FileService $fileService)
    {
        $this->categoryService = $categoryService;
        $this->fileService = $fileService;
    }

    public function index()
    {
        $categories = Category::all()->pluck('name', 'id');
        $categoryTypes = CategoryTypeEnum::labels();

        return view('admin.categories.index', compact('categories', 'categoryTypes'));
    }

    public function store(CategoryStoreRequest $request)
    {
        $category = $this->categoryService->create($request->validated());

        $this->fileService->upload($category, $request->file('thumbnail'), 'thumbnail');

        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        $categories = Category::all()->pluck('name', 'id');
        $categoryTypes = CategoryTypeEnum::labels();

        return view('admin.categories.index', compact('category', 'categories', 'categoryTypes'));
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category = $this->categoryService->update($category, $request->validated());

        $this->fileService->upload($category, $request->file('thumbnail'), 'thumbnail');

        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $this->categoryService->delete($category);

        return redirect()->route('categories.index');
    }
}
