@props([
    'hideHeader' => false,
    'title' => null,
    'subtitle' => null,
])

<div class="rounded-lg">
    @if (!$hideHeader)
        <div class="flex items-center pb-5">
            @if (!empty($title))
                <div>
                    <h1 class="text-lg sm:text-xl md:text-2xl font-semibold">{{ $title }}</h1>
                    @if (!empty($subtitle))
                        <div class="text-sm">{{ $subtitle }}</div>
                    @endif
                </div>
            @endif

            <div class="ml-auto flex gap-1 justify-end items-center">
                @isset($actions)
                    {{ $actions }}
                @endisset
            </div>
        </div>
    @endif

    <div class="grid grid-cols-12 gap-5">
        {{ $slot }}
    </div>
</div>
