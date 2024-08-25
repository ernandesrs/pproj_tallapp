<div class="flex-1 flex flex-col bg-zinc-200 p-2">
    @isset($header)
        <div class="bg-zinc-500">
            {{ $header }}
        </div>
    @endisset
    <div class="flex-1 flex flex-col bg-zinc-800">
        {{ $slot }}
    </div>
</div>
