@props([
    'user' => null,
    'roles'
])
<x-partials.admin.forms.input name="name" value="{{ $user->name ?? '' }}"/>
<x-partials.admin.forms.input name="email" type="email" value="{{ $user->email ?? '' }}"/>
<x-partials.admin.forms.select-multiple name="roles" :options="$roles" :selected="$user->roles()->pluck('id')->toArray() ?? []"/>

@if(request()->routeIs('users.create'))
    <div class="mb-3">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="set_password" id="set_password_checkbox">
            <label class="form-check-label" for="set_password_checkbox">
                Jelszó beállítása
            </label>
        </div>
    </div>

    <div id="password_fields_container" style="display: none;">
        <x-partials.admin.forms.input name="password" type="password"/>
        <x-partials.admin.forms.input name="password_confirmation" type="password"/>
    </div>
@endif

@error('custom')
<p>{{ $message }}</p>
@enderror
@if(request()->routeIs('admin.users.create'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.getElementById('set_password_checkbox');
        const container = document.getElementById('password_fields_container');

        if (checkbox && container) {
            checkbox.addEventListener('change', function() {
                container.style.display = this.checked ? 'block' : 'none';

                if (!this.checked) {
                    container.querySelectorAll('input[type="password"]').forEach(input => {
                        input.value = '';
                    });
                }
            });
        }
    });
</script>
@endif
