@props([
    'icon' => 'app',
    'title' => '',
    'value' => 0,
])

<div {{ $attributes }}>
    <x-card>
        <div class="flex gap-4 items-center">
            <x-bicon name="{{ $icon }}" class="text-5xl lg:text-6xl" />
            <div>
                <h3 class="text-xl">
                    {{ $title }}
                </h3>
                <h3 class="text-4xl">
                    {{ $value }}
                </h3>
            </div>
        </div>
    </x-card>
</div>
