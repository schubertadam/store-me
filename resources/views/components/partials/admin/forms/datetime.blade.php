@props([
    'name',
    'label' => '',
    'value' => '',
    'divClass' => 'mb-3',
    'pickerType' => 'datetime',
    'autocomplete' => 'off',
    'placeholder' => 'Válasszon dátumot és időt...',
])

@php
    if (empty($label)) {
        $label = ucfirst(str_replace('_', ' ', $name));
    }

    $class = trim('form-control ' . ($attributes->get('class') ?? '') . ($errors->has($name) ? ' is-invalid' : ''));

    if ($placeholder === 'Válasszon dátumot és időt...') {
        if ($pickerType === 'date') {
            $placeholder = 'Válasszon dátumot...';
        } elseif ($pickerType === 'time') {
            $placeholder = 'Válasszon időt...';
        }
    }

    $currentValue = old($name, $value);
@endphp

<div class="{{ $divClass }}">

    <label for="{{ $name }}" class="form-label">{{ $label }}</label>

    <input type="text" name="{{ $name }}" id="{{ $name }}"
        value="{{ $currentValue }}"
        {{ $attributes->except('class') }}
        class="{{ $class }}"
        autocomplete="{{ $autocomplete }}"
        data-type="{{ $pickerType }}"
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
