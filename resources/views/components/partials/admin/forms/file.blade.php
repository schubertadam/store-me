@props([
    'name',
    'label' => 'Fájl kiválasztása',
    'divClass' => 'mb-3',
    'currentImageUrl' => null, // <--- ÚJ PROP BEVEZETÉSE
])

@php
    // ... (korábbi kód: label, inputClasses, inputId beállítása) ...
    $inputId = $name . '_file_input';
    $previewContainerId = $inputId . '_preview_container';
    $previewImageId = $inputId . '_preview';
    $inputClasses = trim( // <-- Valószínűleg itt volt a hiba
        'form-control ' .
        ($attributes->get('class') ?? '') .
        ($errors->has($name) ? ' is-invalid' : '')
    );
@endphp

<div class="{{ $divClass }}">

    <label for="{{ $inputId }}" class="form-label">{{ $label }}</label>

    {{-- Kép előnézet konténer --}}
    <div
        id="{{ $previewContainerId }}"
        class="mt-2 mb-3"
        style="display: {{ $currentImageUrl ? 'block' : 'none' }};" {{-- MEGJELENÍTÉS, HA VAN URL --}}
    >
        <img
            id="{{ $previewImageId }}"
            src="{{ $currentImageUrl ?? '#' }}" {{-- ALAP URL beállítása --}}
            alt="Kép előnézet"
            style="max-width: 200px; height: auto; border: 1px solid #ddd; padding: 5px;"
        />

        {{-- Opcionális: a régi kép törlésére szolgáló checkbox bevezetése --}}
        @if ($currentImageUrl)
            <div class="form-check mt-1">
                <input class="form-check-input" type="checkbox" name="delete_{{ $name }}" id="delete_{{ $name }}">
                <label class="form-check-label" for="delete_{{ $name }}">
                    Jelenlegi kép törlése
                </label>
            </div>
        @endif

    </div>

    <input
        type="file"
        name="{{ $name }}"
        id="{{ $inputId }}"
        {{ $attributes->except('class') }}
        class="{{ $inputClasses }}"
        onchange="previewImage(this, '{{ $previewImageId }}', '{{ $previewContainerId }}')"
    >

    @error($name)
    <div class="invalid-feedback d-block">
        {{ $message }}
    </div>
    @enderror

</div>

{{-- Fontos: A fő layout fájlba egyszer be kell szúrni ezt a JavaScriptet! --}}
<script>
    function previewImage(input, previewId, containerId) {
        const file = input.files[0];
        const preview = document.getElementById(previewId);
        const container = document.getElementById(containerId);

        if (file) {
            // Ellenőrizzük, hogy a fájl kép-e
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    container.style.display = 'block'; // Megjelenítjük a konténert
                };
                reader.readAsDataURL(file);
            } else {
                // Nem kép, elrejtjük a konténert
                preview.src = '#';
                container.style.display = 'none';
            }
        } else {
            // Nincs kiválasztott fájl
            preview.src = '#';
            container.style.display = 'none';
        }
    }
</script>
