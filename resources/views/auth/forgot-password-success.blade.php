<x-layouts.auth title="{{ __('Email has been sent') }}">
    <div class="card">
        <div class="card-body p-11 text-center">
            <i class="fa-solid fa-check fs-100 text-green"></i>

            <h4>Well done!</h4>
            <p class="text-muted mx-4">Please check your inbox for further instructions!</p>
            <div class="mt-4">
                <a href="{{ route('login.index') }}" class="btn btn-primary rounded-pill btn-login w-100 mb-2">Back to Login</a>
            </div>
        </div>
    </div>
</x-layouts.auth>
