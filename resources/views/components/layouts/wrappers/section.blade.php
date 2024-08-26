{{--

    Description: section wrapper. This component wraps the header and main.

    Dispatch events:

    Wait for events:

--}}

@props([
    'headerHeight' => 60,
])

@php
    throw_if(!is_numeric($headerHeight), 'headerHeight prop value requires a number');
@endphp

<div class="flex-1 h-full overflow-y-auto flex flex-col">

    {{-- main header --}}
    @isset($header)
        <header class="flex items-center" style="height: {{ $headerHeight }}px">
            {{ $header }}
        </header>
    @endisset

    {{-- main content --}}
    <main class="flex flex-col overflow-y-auto" style="height: calc(100vh - {{ $headerHeight }}px)">
        {{ $slot }}
    </main>
</div>
