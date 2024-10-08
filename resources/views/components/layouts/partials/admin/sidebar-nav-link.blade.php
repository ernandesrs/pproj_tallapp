@props([
    'icon' => null,
    'text' => null,
    'route' => null,
    'activeIn' => [],
    'activator' => false,
    'permissions' => [],
    'target' => null,
])

@php
    $permissionsToStringArray = null;
    if (count($permissions ?? []) > 0) {
        $permissionsToStringArray = array_map(function ($p) {
            return is_string($p) ? $p : $p->value;
        }, $permissions);
    }

    $userCanSeeThisLink = $permissionsToStringArray ? \Auth::user()->can($permissionsToStringArray) : true;
    $isActive = in_array(\Route::currentRouteName(), $activeIn);

    if (isset($route['name'])) {
        $attributes = $attributes->merge([
            'wire:navigate' => true,
            'href' => route($route['name'], $route['params'] ?? []),
        ]);
    } else {
        $attributes = $attributes->merge([
            'href' => $href ?? '#',
        ]);
    }

    $attributes = $attributes->merge([
        'title' => $attributes->get('title') ?? $text,
    ]);
@endphp

@if ($userCanSeeThisLink)

    <a
        x-on:click="clicked"
        x-data="{
            target: '{{ $target }}',
            activator: {{ $activator ? 1 : 0 }},
            activatorState: {
                active: {{ $isActive ? 1 : 0 }}
            },

            init() {
                $nextTick(() => {
                    if (!this.activator) {
                        return
                    }

                    if (this.activatorState.active) {
                        $dispatch('toggle_nav_link_visibility', { id: this.target, show: this.activatorState.active })
                    }
                })
            },

            clicked(event) {
                if (!this.activator) {
                    return;
                }

                this.activatorState.active = !this.activatorState.active
                $dispatch('toggle_nav_link_visibility', { id: this.target, show: this.activatorState.active })
            }
        }"

        class="flex gap-x-3 px-5 py-3 rounded-md mb-1 duration-200 hover:text-zinc-100 hover:bg-indigo-400 dark:hover:bg-indigo-500 {{ $isActive ? 'bg-indigo-400 text-zinc-100 dark:bg-indigo-500' : '' }}"
        :class="{ 'justify-center': asideMiniOn }"
        {{ $attributes }}>

        <x-icon name="{{ $icon }}" />

        <x-transitions.fade
            on-enter-only
            x-show="!asideMiniOn"
            class="flex-1">
            <div class="truncate">
                {{ $text }}
            </div>
        </x-transitions.fade>

        @if ($activator)
            <x-transitions.fade
                on-enter-only
                x-show="!asideMiniOn">
                <x-bicon x-show="!activatorState.active" name="chevron-right" />
                <x-bicon x-show="activatorState.active" name="chevron-down" />
            </x-transitions.fade>
        @endif

    </a>

@endif
