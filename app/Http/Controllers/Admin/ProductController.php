<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ProductSaleTypeEnum;
use App\Enums\ProductStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\FileService;

class ProductController extends Controller
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
        return view('admin.products.index');
    }

    public function create()
    {
        $rootCategories = Category::whereNull('category_id')->with('children')->get();
        $categories = $this->categoryService->buildCategoryTreeOptions($rootCategories);
        $statuses = ProductStatusEnum::labels();

        return view('admin.products.create', compact('categories', 'statuses'));
    }

    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();
        $product = Product::create($data);

        $this->fileService->upload($product, $request->file('thumbnail'), 'thumbnail');
        $this->fileService->uploadMany($product, $request->file('gallery'), 'gallery');

        return redirect()->route('products.index');
    }

    public function edit(Product $product)
    {
        $rootCategories = Category::whereNull('category_id')->with('children')->get();
        $categories = $this->categoryService->buildCategoryTreeOptions($rootCategories);
        $statuses = ProductStatusEnum::labels();
        $saleTypes = ProductSaleTypeEnum::labels();

        return view('admin.products.edit', compact('product', 'categories', 'statuses', 'saleTypes'));
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        $product->update($data);

        $this->fileService->upload($product, $request->file('thumbnail'), 'thumbnail');
        $this->fileService->uploadMany($product, $request->file('gallery'), 'gallery');

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
