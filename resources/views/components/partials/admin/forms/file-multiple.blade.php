@props([
    'name',
    'label' => 'Fájlok kiválasztása',
    'divClass' => '',
    'currentImageUrls' => [], // Tömbként várja a jelenlegi URL-eket
])

@php
    $previewContainerId = $name . '_preview_container';
    $previewGalleryId = $name . '_gallery'; // Galéria ID

    $class = trim('form-control ' . ($errors->has($name) ? ' is-invalid' : ''));
@endphp

<div class="mb-3">

    <label for="{{ $name }}" class="form-label">{{ $label }}</label>

    <div id="{{ $previewContainerId }}" class="mt-2 mb-3">
        @if (!empty($currentImageUrls))
            <div id="{{ $previewGalleryId }}" class="d-flex flex-wrap gap-2 mb-2">
                @foreach ($currentImageUrls as $url)
                    <div class="position-relative border p-1">
                        <img src="{{ $url }}" style="max-width: 150px; height: auto;" alt="Jelenlegi kép" />

                        <div class="form-check mt-1">
                            <input class="form-check-input" type="checkbox" name="delete_existing_{{ $name }}[]" value="{{ basename($url) }}" id="delete_{{ basename($url) }}">
                            <label class="form-check-label small" for="delete_{{ basename($url) }}">
                                Törlés
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Új képek előnézetének helye --}}
        <div id="new_{{ $previewGalleryId }}" class="d-flex flex-wrap gap-2">
        </div>
    </div>

    <input type="file" name="{{ $name }}[]" id="{{ $name }}" multiple="multiple" class="{{ $class }}" onchange="previewMultipleImages(this, 'new_{{ $previewGalleryId }}')">

    @error($name)
    <div class="invalid-feedback d-block">
        {{ $message }}
    </div>
    @enderror

</div>

{{-- 🚀 JavaScript a Többszörös Előnézethez --}}
<script>
    function previewMultipleImages(input, targetGalleryId) {
        const gallery = document.getElementById(targetGalleryId);
        gallery.innerHTML = ''; // Töröljük a korábbi előnézeteket

        if (input.files) {
            Array.from(input.files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const imgWrapper = document.createElement('div');
                        imgWrapper.className = 'position-relative border p-1';

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = file.name;
                        img.style.maxWidth = '150px';
                        img.style.height = 'auto';

                        imgWrapper.appendChild(img);
                        gallery.appendChild(imgWrapper);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    }
</script>
