<div class="flex-1 flex flex-col">

    {{-- main header --}}
    @isset($header)
        <div class="bg-zinc-800 flex items-center">
            {{ $header }}

            {{-- menu toggler wrapper --}}
            <div
                x-data=""
                x-on:click="$dispatch('toggle_aside')"
                class="cursor-pointer ml-auto" role="button">
                <div class="pointer-events-none">
                    @isset($asideToggler)
                        {{ $asideToggler }}
                    @else
                        <div class="px-3 py-1 text-2xl rounded-md">
                            &equiv;
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    @endisset

    {{-- main content --}}
    <div class="flex-1 flex flex-col bg-zinc-700">
        {{ $slot }}
    </div>
</div>
