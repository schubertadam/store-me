@props([
    'name' => 'thumbnail',
    'label' => 'Termékkép',
    'accept' => 'image/png, image/gif, image/jpeg, image/webp',
    'currentImageUrl' => null, // <-- ÚJ: A jelenlegi kép URL-je
])

@php
    if (empty($label)) {
        $label = ucfirst(str_replace('_', ' ', $name));
    }
    $inputId = $name . '-input';
    $imageId = $name . '-img';
    // Használjuk a placeholder-t, ha nincs aktuális kép
    $placeholderUrl = 'https://placehold.co/120x120/E9ECEF/6C757D?text=No+Image';
    $finalImageUrl = $currentImageUrl ?? $placeholderUrl;
@endphp

<label for="{{ $name }}" class="form-label">{{ $label }}</label>

<div class="text-center">
    <div class="position-relative d-inline-block">

        {{-- Gombok/Input Konténer --}}
        <div class="position-absolute top-100 start-100 translate-middle d-flex gap-1">

            {{-- 1. KÉPVÁLASZTÓ GOMB --}}
            <label for="{{ $inputId }}" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Kép kiválasztása">
                <div class="avatar-xs">
                    <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                        <i class="ri-image-fill"></i>
                    </div>
                </div>
            </label>
        </div>

        {{-- Rejtett Fájl Input --}}
        <input
            class="form-control d-none"
            value=""
            id="{{ $inputId }}"
            name="{{ $name }}"
            type="file"
            accept="{{ $accept }}"
        >

        {{-- Kép Megjelenítési Konténer --}}
        <div class="avatar-xl">
            <div class="avatar-title bg-light rounded">
                <img
                    src="{{ $finalImageUrl }}" {{-- <-- A JELENLEGI VAGY PLACEHOLDER KÉP --}}
                id="{{ $imageId }}"
                    class="avatar-lg h-auto"
                    alt="Kép előnézet"
                />
            </div>
        </div>
    </div>
</div>

{{-- Beágyazott JavaScript a kép előnézetéhez --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector("#{{ $inputId }}").addEventListener("change", function () {
            var imageElement = document.querySelector("#{{ $imageId }}"),
                uploadedFile = document.querySelector("#{{ $inputId }}").files[0],
                reader = new FileReader();

            reader.addEventListener(
                "load",
                function () {
                    imageElement.src = reader.result;
                },
                !1
            ),
            uploadedFile && reader.readAsDataURL(uploadedFile);
        });
    });
</script>
