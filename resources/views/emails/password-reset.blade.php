@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => route('reset-password.edit', $token)])
Reset password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
