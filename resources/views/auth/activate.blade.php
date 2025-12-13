<x-layouts.auth title="{{ __('Activation') }}">
    <div class="card">
        <div class="card-body p-11 text-center">
            <i class="fa-solid fa-check fs-100 text-green"></i>

            <h4>Well done!</h4>
            <p class="text-muted mx-4">Activation successful. Please <a href="{{ route('login.index') }}">log in</a> to use our webshop.</p>
        </div>
    </div>
</x-layouts.auth>
