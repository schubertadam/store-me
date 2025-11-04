@component('mail::message')
# Tisztelt {{ $user->name }}!

Köszönjük, hogy regisztrált hozzánk! Fiókjának használatba vételéhez kérjük kattintson az "Akvitálás" gombra.

@component('mail::button', ['url' => route('account.activate', $token)])
    Aktiválás
@endcomponent

Köszönettel,<br>
{{ config('app.name') }}
@endcomponent
