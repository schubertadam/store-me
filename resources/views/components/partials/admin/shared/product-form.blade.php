@props([
    'product' => null,
    'button' => '',
    'categories',
    'statuses'
])
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <x-partials.admin.forms.input name="name" value="{{ $product->name ?? '' }}"/>
                <x-partials.admin.forms.wysiwyg name="description" value="{{ $product->description ?? '' }}"/>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Product Gallery</h5>
            </div>
            <div class="card-body">
                <x-partials.admin.forms.file-multiple name="gallery" :current-image-urls="$product->getGalleryUrls()"/>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#product-general-info" role="tab">
                            General Info
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#product-metadata" role="tab">
                            Meta Data
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="product-general-info" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-6">
                                <x-partials.admin.forms.input name="sku" value="{{ $product->sku ?? '' }}"/>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <x-partials.admin.forms.input name="stock" value="{{ $product->stock ?? '' }}"/>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <x-partials.admin.forms.input name="price" icon="Ft" :icon-start="false" value="{{ $product->price ?? '' }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="product-metadata" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-6">
                                <x-partials.admin.forms.select name="sale_type" :options="$saleTypes" value="{{ $product->sale_type ?? '' }}"/>
                            </div>
                            <div class="col-lg-6">
                                <x-partials.admin.forms.input name="sale_amount" value="{{ $product->sale_amount ?? '' }}"/>
                            </div>
                            <div class="col-lg-6">
                                <x-partials.admin.forms.datetime name="sale_active_from" value="{{ $product->sale_active_from ?? ''}}"/>
                            </div>
                            <div class="col-lg-6">
                                <x-partials.admin.forms.datetime name="sale_active_to" value="{{ $product->sale_active_to ?? '' }}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">
                {{ $button }}
            </button>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Thumbnail</h5>
            </div>
            <div class="card-body pb-4">
                <x-partials.admin.forms.file-avatar name="thumbnail"/>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Product settings</h5>
            </div>
            <div class="card-body">
                <x-partials.admin.forms.select name="category_id" :options="$categories" :searchable="true" :value="$product->category_id ?? ''"/>
                <x-partials.admin.forms.select name="status" :options="$statuses" value="{{ $product->status ?? '' }}"/>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Product Short Description</h5>
            </div>
            <div class="card-body">
                <x-partials.admin.forms.textarea name="summary" value="{{ $product->summary ?? '' }}"/>
            </div>
        </div>
    </div>
</div>
