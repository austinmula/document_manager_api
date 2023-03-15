<x-mail::message>
# Account Creation Success

Welcome to file manager platform. Your default login credentials are:
    - [email] - {{ $email }}
    - [password] - {{ $password }}
{{--<x-mail::button :url="''">--}}
{{--Button Text--}}
{{--</x-mail::button>--}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
