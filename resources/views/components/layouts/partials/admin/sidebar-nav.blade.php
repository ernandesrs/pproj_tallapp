@props([
    'items' => [],
])

<nav class="flex flex-col">

    @foreach ($items as $item)
        @php
            $item = (object) $item;
        @endphp
        <x-layouts.partials.admin.sidebar-nav-link
            :activator="isset($item->items) ? true : false"
            :icon="$item->icon"
            :text="$item->text"
            :route="$item->route ?? null"
            :active-in="$item->activeIn ?? []"
            :permissions="isset($item->permissions) ? $item->permissions : []" />
    @endforeach

</nav>
