@props([
    'title' => null,
])

<div class="my-4 cursor-default">
    @if (!empty($title))
        <div class="mb-2 text-sm text-zinc-500">
            {{ $title }}
        </div>
    @endif
    <div class="">
        {{ $slot }}
    </div>
</div>
