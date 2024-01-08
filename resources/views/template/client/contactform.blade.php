@component('mail::message')
    # {{$subject}}

    ## {{$message}}

    Feel free to contact me via {{$phone}} or {{$email}}

    Thanks,
    {{$name}}

    {{ config('app.name') }}
@endcomponent
