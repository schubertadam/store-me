@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => route('invite.edit', $token)])
Set password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
