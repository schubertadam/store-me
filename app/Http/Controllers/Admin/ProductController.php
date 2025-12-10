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
use Illuminate\Http\Request;

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
        $data = $this->prepareFormData();
        $data['product'] = new Product();

        return view('admin.products.create', $data);
    }

    public function edit(Product $product)
    {
        $data = $this->prepareFormData();
        $data['product'] = $product;

        return view('admin.products.edit', $data);
    }

    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();
        $product = Product::create($data);

        $this->uploadProductMedia($request, $product);

        return redirect()->route('admin.products.index');
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        $product->update($data);

        $this->uploadProductMedia($request, $product);

        return redirect()->route('admin.products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index');
    }

    private function prepareFormData(): array
    {
        $rootCategories = Category::whereNull('category_id')->with('children')->get();

        return [
            'categories' => $this->categoryService->buildCategoryTreeOptions($rootCategories),
            'statuses' => ProductStatusEnum::labels(),
            'saleTypes' => ProductSaleTypeEnum::labels(),
        ];
    }

    private function uploadProductMedia(Request $request, Product $product): void
    {
        $this->fileService->upload($product, $request->file('thumbnail'), 'thumbnail');
        $this->fileService->uploadMany($product, $request->file('gallery'), 'gallery');
    }
}
