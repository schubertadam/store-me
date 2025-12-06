@foreach ($categories as $category)
    @php
        $targetId = 'cat-' . $category->id;
        $isActive = ($category->id == $this->categoryFilter);

        // KULCS: Megnézzük, hogy az aktuális kategória az aktív szűrő szülője-e
        $isAncestor = in_array($category->id, $this->activeCategoryPath);
        $shouldBeOpen = $isActive || $isAncestor;
    @endphp

    <li class="mb-1 @if(isset($isChild)) ps-2 @endif">
        <a href="#"
           wire:click.prevent="$set('categoryFilter', {{ $category->id }})"
           class="align-items-center rounded link-body @if($isActive) active @endif"

           @if ($category->children->isNotEmpty())
               data-bs-toggle="collapse"
           data-bs-target="#{{ $targetId }}"
           aria-expanded="{{ $shouldBeOpen ? 'true' : 'false' }}"
            @endif
        >
            {{ $category->name }}
            <span class="fs-sm text-muted ms-1">({{ $category->products_count ?? 0 }})</span>
        </a>

        {{-- A Collapse DIV --}}
        @if ($category->children->isNotEmpty())
            <div class="collapse mt-1 @if($shouldBeOpen) show @endif" id="{{ $targetId }}">
                <ul class="btn-toggle-nav list-unstyled ps-2">
                    {{-- Rekurzívan adjuk át az activeCategoryPath-t, ami a komponensben van --}}
                    @include('components.partials.guest.shop.category-tree', ['categories' => $category->children, 'isChild' => true])
                </ul>
            </div>
        @endif
    </li>
@endforeach
