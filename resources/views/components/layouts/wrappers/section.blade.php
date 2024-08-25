<div class="flex-1 flex flex-col">

    {{-- main header --}}
    @isset($header)
        <header class="flex items-center">
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
        </header>
    @endisset

    {{-- main content --}}
    <main class="flex-1 flex flex-col">
        {{ $slot }}
    </main>
</div>
