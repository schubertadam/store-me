@props([
    'name',
    'label' => '',
    'options' => [],   // A választható opciók tömbje (érték => címke)
    'selected' => [],  // A már kiválasztott értékek (tömb)
    'divClass' => 'mb-3',
])

@php
    // Címke generálása a 'name'-ből, ha hiányzik
    if (empty($label)) {
        $label = ucfirst(str_replace('_', ' ', $name));
    }

    // 1. A legfontosabb: A name attribútumot tömbként kell küldeni!
    $inputName = $name . '[]';

    // 2. A kiválasztott értékek előkészítése: old() vagy a $selected prop
    // Megjegyzés: A Laravel old() metódusa automatikusan tömböt ad vissza többszörös select esetén
    $currentSelected = old($name, $selected);

    // Select CSS osztályok beállítása (Bootstrap form-select)
    $selectClasses = trim(
        'form-select ' .
        ($attributes->get('class') ?? '') .
        // Validációs hiba ellenőrzése a tömbösített néven
        ($errors->has($name) ? ' is-invalid' : '')
    );
@endphp

<div class="{{ $divClass }}">

    <label for="{{ $name }}" class="form-label">{{ $label }}</label>

    <select
        name="{{ $inputName }}"
        id="{{ $name }}"
        multiple="multiple"
        {{ $attributes->except('class') }}
        class="{{ $selectClasses }} form-control select2-multiple"  {{-- <-- ÚJ OSZTÁLY --}}
    >
        {{-- Iterálás az átadott opciókon --}}
        @foreach ($options as $optionValue => $optionLabel)
            <option
                value="{{ $optionValue }}"
                {{-- Ellenőrzés, hogy az érték benne van-e a kiválasztott tömbben --}}
                @if(in_array((string)$optionValue, (array)$currentSelected))
                    selected
                @endif
            >
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>

    @error($name)
    <div class="invalid-feedback d-block">
        {{ $message }}
    </div>
    @enderror

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Használhatsz jQuery-t, ha már van a projektben:
        $('.select2-multiple').select2({
            theme: "bootstrap", // Opcionális, ha a Select2-nek van Bootstrap témája
            placeholder: "Kezdj el gépelni a választáshoz...",
            allowClear: true
        });

        // Vagy natív JS-t:
        // (A Select2-nek szüksége van a jQuery-re, a Tom Select viszont nem)
    });
</script>
