@props([
    'icon' => 'app',
    'title' => '',
    'value' => 0,

    /**
     * Footer links
     */
    'links' => [
        /**
         * Each item can be:
         * [
         *      'text' => 'Link text',
         *      'href' => 'Link',
         *      'external' => false,
         *      'icon' => 'link'
         * ]
         */
    ],
])

<div {{ $attributes }}>
    <x-card>
        <div class="flex gap-4 items-center text-zinc-600 dark:text-zinc-300">
            <x-icon name="{{ $icon }}" class="w-11 h-11" />
            <div>
                <h3 class="text-xl">
                    {{ $title }}
                </h3>
                <h3 class="text-4xl text-zinc-700 dark:text-zinc-100">
                    {{ $value }}
                </h3>
            </div>
        </div>

        @if (count($links))
            <x-slot:footer>
                @foreach ($links as $link)
                    @php
                        $link = (object) $link;
                    @endphp
                    <x-link :href="$link->href" :text="$link->text" :icon="$link->icon ?? ''" position="left" :navigate="!($link->external ?? false)" />
                @endforeach
            </x-slot:footer>
        @endif
    </x-card>
</div>
