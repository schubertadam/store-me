<x-layouts.admin title="Edit product">
    <h1>Edit product</h1>
    <a href="{{ route('products.index') }}">back</a>
    <hr>
    <x-partials.admin.form action="{{ route('products.update', $product) }}" method="PATCH" button="Update" has-file="true">
        <x-partials.admin.forms.select name="category_id" :options="$categories" :value="$product->category_id" searchable="true"/>
        <x-partials.admin.forms.input name="sku" value="{{ $product->sku }}"/>
        <x-partials.admin.forms.input name="name" value="{{ $product->name }}"/>
        <x-partials.admin.forms.textarea name="summary" :value="$product->summary"/>
        <x-partials.admin.forms.wysiwyg name="description" :value="$product->description"/>
        <x-partials.admin.forms.input name="price" value="{{ $product->price }}"/>
        <x-partials.admin.forms.input name="stock" value="{{ $product->stock }}"/>
        <x-partials.admin.forms.select name="status" :options="$statuses" value="{{ $product->status }}"/>
        <x-partials.admin.forms.select name="sale_type" :options="$saleTypes" value="{{ $product->sale_type }}"/>
        <x-partials.admin.forms.input name="sale_amount" value="{{ $product->sale_amount }}"/>
        <x-partials.admin.forms.datetime name="sale_active_from" value="{{ $product->sale_active_from }}"/>
        <x-partials.admin.forms.datetime name="sale_active_to" value="{{ $product->sale_active_to }}"/>
        <x-partials.admin.forms.file name="thumbnail"/>
        <x-partials.admin.forms.file-multi name="gallery"/>
    </x-partials.admin.form>
</x-layouts.admin>
