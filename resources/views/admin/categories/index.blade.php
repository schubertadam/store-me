<x-layouts.admin title="Categories">
    <x-partials.admin.layout.page-title title="categories"/>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    @if(Route::is('admin.categories.index'))
                        <x-partials.admin.form action="{{ route('admin.categories.store') }}" button="Add" has-file="true">
                            <x-partials.admin.shared.category-form
                                :category="$category"
                                :categories="$categories"
                                :category-types="$categoryTypes"
                            />
                        </x-partials.admin.form>
                    @else
                        <x-partials.admin.form action="{{ route('admin.categories.update', $category) }}" method="PATCH" button="Update" has-file="true">
                            <x-partials.admin.shared.category-form
                                :category="$category"
                                :categories="$categories"
                                :category-types="$categoryTypes"
                            />
                        </x-partials.admin.form>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <livewire:categories-datatable />
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
