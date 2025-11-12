@props([
    'name',
    'label' => '',
    'value' => '',
    'divClass' => 'mb-3',
    'pickerType' => 'datetime',
    'autocomplete' => 'off',
    'placeholder' => 'Válasszon dátumot és időt...', // <-- ÚJ PROP ALAPÉRTELMEZETT ÉRTÉKKEL
])

@php
    // Címke generálása a 'name'-ből
    if (empty($label)) {
        $label = ucfirst(str_replace('_', ' ', $name));
    }

    // CSS osztályok beállítása, figyelembe véve a hibákat
    $inputClasses = trim(
        'form-control ' .
        ($attributes->get('class') ?? '') .
        ($errors->has($name) ? ' is-invalid' : '')
    );

    if ($placeholder === 'Válasszon dátumot és időt...') {
        if ($pickerType === 'date') {
            $placeholder = 'Válasszon dátumot...';
        } elseif ($pickerType === 'time') {
            $placeholder = 'Válasszon időt...';
        }
    }

    // A mező aktuális értéke
    $currentValue = old($name, $value);
    // Egyedi ID a JavaScript inicializáláshoz
    $inputId = 'picker-' . $name;
@endphp

<div class="{{ $divClass }}">

    <label for="{{ $inputId }}" class="form-label">{{ $label }}</label>

    <input
        type="text" {{-- A Flatpickr (vagy más) miatt "text" típust használunk --}}
    name="{{ $name }}"
        id="{{ $inputId }}"
        value="{{ $currentValue }}"
        {{ $attributes->except('class') }}
        class="{{ $inputClasses }}"
        autocomplete="{{ $autocomplete }}"
        data-type="{{ $pickerType }}" {{-- Speciális attribútum a JS-nek --}}
        placeholder="{{ $placeholder }}"
    >

    @error($name)
    <div class="invalid-feedback d-block">
        {{ $message }}
    </div>
    @enderror

</div>

{{-- 🚀 JavaScript Inicializálás (Példa Flatpickr-rel) --}}
{{-- Ezt a szkriptet be kell szúrni a fő layout fájlba egyszer,
     vagy a komponens aljára, ha azt akarjuk, hogy csak használatkor töltődjön be. --}}
@if (!app()->has('flatpickr_initialized'))
    @php app()->instance('flatpickr_initialized', true); @endphp

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializáljuk a Flatpickr-t minden mezőre, ami a .form-control és data-type attribútumot tartalmazza
            document.querySelectorAll('input.form-control[data-type]').forEach(function(input) {
                const type = input.getAttribute('data-type');
                let config = {};

                if (type === 'date') {
                    config = { dateFormat: 'Y-m-d', enableTime: false };
                } else if (type === 'time') {
                    config = { enableTime: true, noCalendar: true, dateFormat: 'H:i' };
                } else { // datetime
                    config = {
                        enableTime: true,
                        dateFormat: 'Y-m-d H:i', // Laravel barát formátum
                        time_24hr: true
                    };
                }

                // Csak akkor inicializáljuk, ha a Flatpickr globálisan elérhető
                if (typeof flatpickr === 'function') {
                    flatpickr(input, config);
                } else {
                    console.error("Flatpickr JS library not found. Please include it in your layout.");
                }
            });
        });
    </script>
@endif
