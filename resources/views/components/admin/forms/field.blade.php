<div class="mb-3">
    @if(!$noLabel)
        <label for="{{ $name }}" class="small mb-1">
            {{ $label ?? __(str_replace('_', ' ', ucfirst($name))) }}
        </label>
    @endif
    {{ $slot }}

    @if($errors->has($name))
        <div class="invalid-feedback">
            {{ $errors->first($name) }}
        </div>
    @else
        @isset($help)
            <div class="form-text">
                {{ $help }}
            </div>
        @endisset
    @endif
</div>
