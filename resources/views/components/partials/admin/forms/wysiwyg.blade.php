@props([
    'name',
    'label' => '',
    'value' => '',   // A textarea tartalma
    'rows' => 5,     // Alapértelmezett magasság
    'divClass' => 'mb-3',
])

@php
    // Címke generálása a 'name'-ből, ha hiányzik
    if (empty($label)) {
        $label = ucfirst(str_replace('_', ' ', $name));
    }

    // CSS osztályok beállítása, figyelembe véve a hibákat
    $textareaClasses = trim(
        'form-control ' . // Bootstrap form-control class
        ($attributes->get('class') ?? '') .
        ($errors->has($name) ? ' is-invalid' : '')
    );

    // A régi (old) érték lekérése, vagy a props-ban átadott érték használata
    $currentValue = old($name, $value);
@endphp

<div class="{{ $divClass }}">

    <label for="{{ $name }}" class="form-label">{{ $label }}</label>

    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        {{ $attributes->except('class') }}
        class="{{ $textareaClasses }}"
    >{{ $currentValue }}</textarea>

    @error($name)
    <div class="invalid-feedback d-block">
        {{ $message }}
    </div>
    @enderror

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#{{ $name }}').summernote({
            height: 300,
            callbacks: {
                onImageUpload: function(files) {
                    for (let i = 0; i < files.length; i++) {
                        uploadImage(files[i]);
                    }
                }
            }
        });

        function uploadImage(file) {
            let data = new FormData();
            data.append('image', file);

            $.ajax({
                url: '{{ route('admin.summernote.upload') }}',
                method: 'POST',
                data: data,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (data) {
                    console.log(data);
                    $('#{{ $name }}').summernote('insertImage', data.url);
                },
                error: function (xhr) {
                    console.error('Feltöltési hiba:', xhr.responseText);
                    alert('Hiba történt a fájl feltöltése közben.');
                }
            });
        }
    });
</script>
