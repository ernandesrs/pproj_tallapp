@props([
    'hideHeader' => false,
])

<div class="rounded-lg">
    @if (!$hideHeader)
        <div class="flex items-center pb-5">
            @if (!empty($this->page()->getTitle()))
                <div>
                    <h1 class="text-lg sm:text-xl md:text-2xl font-semibold">{{ $this->page()->getTitle() }}</h1>
                    @if (!empty($this->page()->getSubtitle()))
                        <div class="text-sm">{{ $this->page()->getSubtitle() }}</div>
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
