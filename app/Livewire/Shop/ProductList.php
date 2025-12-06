<?php

namespace App\Livewire\Shop;

use App\Enums\ProductStatusEnum;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    // --- Szűrő Állapotok ---
    public string $orderBy = 'newness';
    public ?int $categoryFilter = null;
    public ?int $ratingFilter = null;
    public int $minPrice = 10000;
    public int $maxPrice = 500000; // Ársáv max értéke
    public array $activeCategoryPath = [];


    public static function getDescendantIds(int $categoryId): array
    {
        $descendants = [];
        $children = Category::where('category_id', $categoryId)->get();

        foreach ($children as $child) {
            // Hozzáadjuk a gyermek ID-ját
            $descendants[] = $child->id;

            // Rekurzívan lekérjük a gyermekek gyermekeit
            $descendants = array_merge($descendants, self::getDescendantIds($child->id));
        }

        return $descendants;
    }

    public static function getAncestorIds(int $categoryId): array
    {
        $ancestorIds = [];
        $category = Category::find($categoryId);

        // Visszalépés a szülői hierarchián (rekurzív)
        while ($category && $category->category_id) {
            $ancestorIds[] = $category->category_id;
            $category = $category->parent; // Feltételezve, hogy van 'parent' reláció
        }

        return $ancestorIds;
    }


    protected function queryString(): array
    {
        return [
            'orderBy' => ['except' => 'newness'],
            'categoryFilter' => ['except' => null, 'as' => 'category'],
            'minPrice' => ['except' => 10000],
            'maxPrice' => ['except' => 500000],
            'page' => ['except' => 1],
        ];
    }

    // --- Életciklus és Frissítés ---

    public function mount(?int $categoryId = null): void
    {
        // Kezdeti kategória szűrő beállítása (ha URL-ből jön)
        $this->categoryFilter = $categoryId;
        $this->calculateActivePath();
    }

    // Minden szűrő/rendezés változásnál visszaállítjuk az oldalszámot
    public function updated($property)
    {
        if (in_array($property, ['orderBy', 'categoryFilter', 'minPrice', 'maxPrice', 'ratingFilter'])) {
            $this->resetPage();
        }
    }

    // --- Lekérdezés ---

    protected function getProductsQuery(): Builder
    {
        $query = Product::query()->where('status', ProductStatusEnum::ACTIVE);

        // 1. Kategória Szűrés
        if ($this->categoryFilter) {
            // Lekérjük az összes ID-t, amit figyelembe kell venni
            $descendantIds = $this::getDescendantIds($this->categoryFilter);

            // Hozzáadjuk a szülő ID-ját is a listához, ha azon is lehet termék
            $filterIds = array_merge([$this->categoryFilter], $descendantIds);

            // KULCS: whereIn-nel szűrünk a teljes leszármazott listára
            $query->whereIn('category_id', $filterIds);
        }

        // 2. Ár Szűrés (A range slider miatt)
        $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);

        // 3. Rating Szűrés
        if ($this->ratingFilter) {
            // Feltételezve, hogy van 'avg_rating' oszlop a product táblában
            $query->where('avg_rating', '>=', $this->ratingFilter);
        }

        // 4. Rendezés
        switch ($this->orderBy) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newness':
            default:
                $query->latest('created_at');
                break;
        }

        return $query;
    }

    public function render(): View
    {
        $sortOptions = [];
        // Lekérjük a kategóriákat a szűrő oldalsávhoz
        $categories = Category::whereNull('category_id')
            ->with('children')
            ->withCount('products')
            ->get();

        // Pagination alkalmazása a lekérdezésre
        $products = $this->getProductsQuery()->paginate(9);

        return view('livewire.shop.product-list', compact('products', 'categories', 'sortOptions'));
    }

    public function updatedCategoryFilter()
    {
        $this->resetPage();
        $this->calculateActivePath();
    }

    // Helper metódus a szülők ID-inak lekérésére
    protected function calculateActivePath(): void
    {
        if ($this->categoryFilter) {
            // A Category modellnek szüksége van egy helper metódusra: getAncestorIds()
            $this->activeCategoryPath = $this::getAncestorIds($this->categoryFilter);
        } else {
            $this->activeCategoryPath = [];
        }
    }
}
