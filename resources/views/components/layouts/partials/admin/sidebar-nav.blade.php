@props([
    'items' => [],
])

<nav {{ $attributes->merge([
    'class' => 'flex flex-col',
]) }}>

    @foreach ($items as $item)
        @php
            $uniqueId = uniqid();
            $item = (object) $item;
            $hasSubmenu = isset($item->items);
        @endphp
        <x-layouts.partials.admin.sidebar-nav-link
            :activator="$hasSubmenu"
            :icon="$item->icon"
            :text="$item->text"
            :route="$item->route ?? null"
            :active-in="$item->activeIn ?? []"
            :permissions="isset($item->permissions) ? $item->permissions : []"
            :target="$uniqueId" />
        @if ($hasSubmenu)
            <div
                x-on:toggle_nav_link_visibility.window="toggleSubnav"
                x-data="{
                    id: '{{ $uniqueId }}',
                    show: false,

                    toggleSubnav(e) {
                        console.log(e)
                        const eventData = e.detail

                        if (eventData.id != this.id) {
                            return
                        }

                        this.show = eventData.show
                    }
                }"
                x-show="show"

                x-transition:enter="duration-200 ease-in-out"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"

                x-transition:leave="duration-75 ease-in"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"

                class="ml-5 mb-5 overflow-hidden">
                <x-layouts.partials.admin.sidebar-nav
                    :items="$item->items" />
            </div>
        @endif
    @endforeach

</nav>
