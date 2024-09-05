@props([
    'quantities' => [5, 10, 15],
])

<div

    x-data="{
        showMoreFilters: {{ $this->isFiltering() ? 1 : 0 }}
    }"

    class="">
    <div class="grid grid-cols-12 gap-3 mb-4">
        <div class="col-span-3 md:col-span-2 xl:col-span-1">
            <x-select.native wire:model.live='quantity' label="Quantidade" :options="$quantities" />
        </div>
        <div class="col-span-2 md:col-span-5 xl:col-span-7"></div>
        <div class="col-span-7 md:col-span-5 xl:col-span-4 flex items-end gap-x-2">
            <div class="flex-1">
                <x-input wire:model.debounce.live="search" label="Buscar..." placeholder="Buscar..." />
            </div>
            <x-button x-show="!showMoreFilters" x-on:click="showMoreFilters=!showMoreFilters" icon="filter"
                color="zinc" />
            <x-button x-show="showMoreFilters" x-on:click="showMoreFilters=!showMoreFilters" icon="filter"
                color="primary" text="Ocultar filtros" />
        </div>
    </div>

    <div

        x-show="showMoreFilters"

        x-transition:enter="duration-100 ease-in-out"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 -translate-y-0"

        x-transition:leave="duration-75 ease-in"
        x-transition:leave-start="opacity-100 -translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"

        class="mb-4">
        <div
            class="bg-zinc-100 border dark:bg-zinc-800 dark:border-zinc-700 mb-5 rounded-md px-6 py-4">
            <div class="flex items-center gap-x-4 py-2 mb-2">
                Filtros extras
            </div>
            <div class="grid grid-cols-12 gap-3 mb-4">

                {{-- selects --}}
                @foreach (static::filterSelects() as $select)
                    @php
                        $select = (object) $select;
                    @endphp

                    <x-admin.list.filter.container>
                        <x-select.native wire:model="selects.{{ $select->index }}" :options="[['label' => 'Nenhum', 'value' => null], ...$select->options]"
                            label="{{ $select->label }}" select="label:label|value:value" />
                    </x-admin.list.filter.container>
                @endforeach

                {{-- between datas --}}
                @foreach (static::filterPeriods() as $period)
                    @php
                        $period = (object) $period;
                    @endphp
                    <x-admin.list.filter.container title="Filtro por período({{ $period->label }})">
                        <x-input type="date" wire:model="periods.{{ $period->index }}.start"
                            label="De:" />

                        <x-input type="date" wire:model="periods.{{ $period->index }}.end"
                            label="Até:" />
                    </x-admin.list.filter.container>
                @endforeach

            </div>
            <div class="flex justify-center items-center gap-x-3">
                @if ($this->isFiltering())
                    <x-button wire:click="clearFilters" icon="filter-x" color="rose" text="Limpar filtros" />
                @endif
                <x-button wire:click="applyFilters" icon="filter-check" text="Aplicar filtro" />
            </div>
        </div>
    </div>
</div>
