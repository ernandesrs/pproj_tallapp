@props([
    'hideHeader' => false,
    'page' => null,
])

@php
    throw_if(empty($page), 'Requires a "\App\Builders\Page\Page" instance to "page" prop.');
@endphp

<div class="rounded-lg">
    @if (!$hideHeader)
        <div class="flex items-center pb-5">
            @if (!empty($page->getTitle()))
                <div>
                    @if (!empty($page->getBreadcrumb()))
                        <nav class="mb-1" aria-label="Breadcrumb">
                            <ol class="flex items-center gap-1 text-sm text-zinc-500 dark:text-zinc-400">
                                @php
                                    $breads = $page->getBreadcrumb()->get();
                                @endphp
                                @foreach ($breads as $key => $bread)
                                    <li>
                                        <a wire:navigate
                                            href="{{ route($bread->route['name'], $bread->route['params'] ?? []) }}"
                                            class="block transition {{ \Route::currentRouteName() == $bread->route['name'] ? 'pointer-events-none text-zinc-400 dark:text-zinc-600' : 'hover:text-primary-500 dark:hover:text-primary-600' }}">
                                            @if ($key == 0)
                                                <span class="sr-only"> {{ $bread->label }} </span>
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="size-4"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                                </svg>
                                            @else
                                                <span> {{ $bread->label }} </span>
                                            @endif
                                        </a>
                                    </li>
                                    @isset($breads[$key + 1])
                                        <li class="rtl:rotate-180">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="size-4"
                                                viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </li>
                                    @endisset
                                @endforeach
                            </ol>
                        </nav>
                    @endif

                    <div>
                        <h1 class="text-lg sm:text-xl md:text-2xl font-semibold">{{ $page->getTitle() }}</h1>
                        @if (!empty($page->getSubtitle()))
                            <div class="text-sm">{{ $page->getSubtitle() }}</div>
                        @endif
                    </div>
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
