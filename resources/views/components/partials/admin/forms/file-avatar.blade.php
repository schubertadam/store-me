@props([
    'name',
    'label' => '',
    'accept' => 'image/png, image/gif, image/jpeg, image/webp',
    'currentImageUrl' => '',
])

@php
    if (empty($label)) {
        $label = ucfirst(str_replace('_', ' ', $name));
    }

    $imageId = $name . '-img';
    $placeholder = !empty($currentImageUrl) ? $currentImageUrl : 'https://placehold.co/120x120/E9ECEF/6C757D?text=No+Image';
@endphp
<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>

    <div class="text-center">
        <div class="position-relative d-inline-block">

            <div class="position-absolute top-100 start-100 translate-middle d-flex gap-1">
                <label for="{{ $name }}" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="{{ __('Select image') }}">
                    <div class="avatar-xs">
                        <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                            <i class="ri-image-fill"></i>
                        </div>
                    </div>
                </label>
            </div>

            <input name="{{ $name }}" id="{{ $name }}" type="file" class="form-control d-none" accept="{{ $accept }}">

            <div class="avatar-xl">
                <div class="avatar-title bg-light rounded">
                    <img src="{{ $placeholder }}" id="{{ $imageId }}" class="avatar-lg h-auto" alt="{{ $name . ' ' . __('$placeholder') }}"/>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', () => {
    const fileInput = document.querySelector("#{{ $name }}");
    const imageElement = document.querySelector("#{{ $imageId }}");

    fileInput.addEventListener("change", (e) => {
        const uploadedFile = e.target.files[0];

        if (uploadedFile) {
            const reader = new FileReader();

            reader.addEventListener("load", () => {
                imageElement.src = reader.result;
            }, false);

            reader.readAsDataURL(uploadedFile);
        }
    });
});
</script>
