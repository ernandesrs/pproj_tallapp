@props([
    'icon' => null,
    'title' => null,
    'subtitle' => null,
])

@php
    $showHeader = !empty($title);
@endphp

<div {{ $attributes->merge([
    'class' => '',
]) }}>
    <x-card>
        @if ($showHeader)
            <x-slot:header>
                {{-- same code --}}
                <div class="flex items-center gap-x-4">
                    @if (!empty($icon))
                        <x-icon :name="$icon" class="{{ empty($subtitle) ? 'w-8 h-8' : 'w-11 h-11' }}" />
                    @endif
                    <div class="flex-1 h-full">
                        <h2 class="text-lg font-semibold">{{ $title }}</h2>
                        <h3 class="text-sm text-zinc-400 font-normal">{{ $subtitle }}</h3>
                    </div>
                </div>
                {{-- /same code --}}
            </x-slot:header>
        @endif

        <div class="">
            {{ $slot }}
        </div>
    </x-card>
</div>
