@component('mail::message')
# User contact

Form: {{ $user['email'] }}

User name: {{ $user['name'] }}

Subject: {{ $user['subject'] }}

Message: {{ $user['message'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
