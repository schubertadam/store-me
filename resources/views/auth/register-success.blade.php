<x-layouts.auth title="Registration successful">
    <div class="card mt-4">
        <div class="card-body p-4 text-center">
            <div class="avatar-lg mx-auto mt-2">
                <div class="avatar-title bg-light text-success display-3 rounded-circle">
                    <i class="ri-checkbox-circle-fill"></i>
                </div>
            </div>
            <div class="mt-4 pt-2">
                <h4>Well done !</h4>
                <p class="text-muted mx-4">Registration successful. Please check your inbox for activation!</p>
                <div class="mt-4">
                    <a href="{{ route('login.index') }}" class="btn btn-success w-100">Back to Login</a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>
