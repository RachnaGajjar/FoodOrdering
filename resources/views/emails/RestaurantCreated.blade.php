@component('mail::message')
<h1>{{ $details['title'] }}</h1>
<p>Name: {{ $details['name'] }}</p>
<p>Email: {{ $details['email'] }}</p>
<p>Password: {{ $details['password'] }}</p>
<a href="{{ url('/user/verify', $details['token']) }}" class="btn btn-primary btn-lg disabled">Verification</a>
@endcomponent
Thanks,<br>
{{ config('app.name') }}
