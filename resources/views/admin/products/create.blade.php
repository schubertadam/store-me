<x-layouts.admin title="Create product">
    <h1>Create product</h1>
    <a href="{{ route('products.index') }}">back</a>
    <hr>
    <x-partials.admin.form action="{{ route('products.store') }}" button="Add" has-file="true">
        <x-partials.admin.forms.select name="category_id" :options="$categories" searchable="true"/>
        <x-partials.admin.forms.input name="sku"/>
        <x-partials.admin.forms.input name="name"/>
        <x-partials.admin.forms.textarea name="summary"/>
        <x-partials.admin.forms.wysiwyg name="description"/>
        <x-partials.admin.forms.input name="price"/>
        <x-partials.admin.forms.input name="stock"/>
        <x-partials.admin.forms.select name="status" :options="$statuses"/>
        <x-partials.admin.forms.file name="thumbnail"/>
        <x-partials.admin.forms.file-multi name="gallery"/>
    </x-partials.admin.form>
</x-layouts.admin>
