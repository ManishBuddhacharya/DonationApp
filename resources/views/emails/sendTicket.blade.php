@component('mail::message')
Dear {{ucwords($user->name)}},

Donation APP would like to thank you for attending <strong>{{$event->title}}</strong>. We hope you had fun, and we look forward to seeing you at the next event:


{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}
We truly appreciate your support. Please let us know if you have any questions. 

Thank  you,<br>
{{ config('app.name') }}
@endcomponent
