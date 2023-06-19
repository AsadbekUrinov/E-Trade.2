@component('mail::message')
# Greetings!

{!! $demo->message !!}

<br>
Kind regards,<br>
{{ $demo->sender }}.
@endcomponent
