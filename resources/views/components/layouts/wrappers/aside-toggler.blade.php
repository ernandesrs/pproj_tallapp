{{--

    Description: sidebar toggle wrapper.

    Dispatch events:
    - toggle_aside

    Wait for events:

--}}

<div
    x-data=""
    x-on:click="$dispatch('toggle_aside')"
    class="cursor-pointer ml-auto" role="button">
    <div class="pointer-events-none">
        @isset($toggler)
            {{ $toggler }}
        @else
            <div class="px-3 py-1 text-2xl rounded-md">
                &equiv;
            </div>
        @endisset
    </div>
</div>
