@props([
    'title' => '---',
])

<div
    {{ $attributes->merge([
        'class' => 'border dark:border-zinc-700 py-2 px-3 rounded-md col-span-12 sm:col-span-6 lg:col-span-4 xl:col-span-3',
    ]) }}>
    <div class="text-xs text-zinc-400 mb-2 cursor-default">
        {{ $title }}
    </div>

    <div class="flex flex-col gap-y-2">
        {{ $slot }}
    </div>
</div>
