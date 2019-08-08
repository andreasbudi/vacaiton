

@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    {{-- Body --}}
    Your Leave Request detail :

    Date          : From {{ $dataClient['from']}} to {{ $dataClient['to']}}

    Duration      : {{ $dataClient['duration']}} days

    Leave Type    : {{ $dataClient['leave_type']}}

    Reason        : {{ $dataClient['reason']}}

    Status        : Waiting for approval
    
    Leave balance : {{ $dataClient['leaves_available']}} days
    
    You can edit or cancel your request by clicking this link below
    http://localhost:8000/home

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
