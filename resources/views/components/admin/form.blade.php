@php
    $fileExtension = isset($fileUpload) ? 'enctype="multipart/form-data"' : '';
@endphp
<form action="{{ $action }}" method="{{ isset($method) && $method == 'get'? 'get' : 'post' }}" {{ $fileExtension }}>
    @csrf
    @method(strtoupper($method ?? 'post'))

    {{ $slot }}

    @isset($button)
        <button type="submit" class="btn btn-primary">
            {{ $button }}
        </button>
    @endisset
</form>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', (e) => {
                if (form.classList.contains('is-submitting')) {
                    e.preventDefault();
                    return;
                }
                form.classList.add('is-submitting');
                form.querySelectorAll('button[type="submit"], input[type="submit"]').forEach(btn => {
                    btn.disabled = true;
                    btn.classList.add('is-disabled');
                    if (btn.tagName === 'BUTTON' && btn.textContent.trim().length) {
                        btn.dataset.origText = btn.textContent;
                        btn.textContent = 'Sending...';
                    }
                });
            });
        });
    });
</script>
