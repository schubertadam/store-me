<x-layouts.admin title="Categories">
    <h1>Categories</h1>
    <hr>
    <div class="row">
        <div class="col-4">
            @if(Route::is('categories.index'))
                <x-partials.admin.form action="{{ route('categories.store') }}" button="Add" has-file="true">
                    <x-partials.admin.forms.input name="name"/>
                    <x-partials.admin.forms.select name="type" label="Kategória típusa" :options="$categoryTypes"/>
                    <x-partials.admin.forms.select name="category_id" label="Szülő" :options="$categories"/>
                    <x-partials.admin.forms.file name="thumbnail"/>
                    <x-partials.admin.forms.textarea name="description"/>
                </x-partials.admin.form>
            @else
                <x-partials.admin.form action="{{ route('categories.update', $category) }}" method="PATCH" button="Update" has-file="true">
                    <x-partials.admin.forms.input name="name" value="{{ $category->name }}"/>
                    <x-partials.admin.forms.select name="type" label="Kategória típusa" :options="$categoryTypes" :value="$category->type->value"/>
                    <x-partials.admin.forms.select name="category_id" label="Szülő" :options="$categories" :value="$category->parent->id ?? null"/>
                    <x-partials.admin.forms.file name="thumbnail" :current-image-url="$category->getThumbnailUrlAttribute()"/>
                    <x-partials.admin.forms.textarea name="description" value="{{ $category->description }}"/>
                </x-partials.admin.form>
            @endif
        </div>
        <div class="col-8">
            <livewire:categories-datatable />
        </div>
    </div>
</x-layouts.admin>
