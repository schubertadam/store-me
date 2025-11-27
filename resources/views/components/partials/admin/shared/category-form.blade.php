@props([
    'category' => null,
    'button' => '',
    'categories',
    'categoryTypes'
])
<x-partials.admin.forms.input name="name" value="{{ $category->name ?? '' }}"/>
<x-partials.admin.forms.select name="type" label="Kategória típusa" :options="$categoryTypes" :value="$category->type->value ?? ''"/>
<x-partials.admin.forms.select name="category_id" label="Szülő" :options="$categories" :value="$category->parent->id ?? null" :searchable="true"/>
<x-partials.admin.forms.file-avatar name="thumbnail" :current-image-url="$category->getThumbnailUrlAttribute() ?? ''"/>
<x-partials.admin.forms.textarea name="description" value="{{ $category->description ?? '' }}"/>
