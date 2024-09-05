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
                color="primary" />
        </div>
    </div>

    <div

        x-show="showMoreFilters"

        class="mb-4">
        <div
            class="bg-zinc-100 border dark:bg-zinc-800 dark:border-zinc-700 mb-5 rounded-md px-6 py-4">
            <div class="flex items-center gap-x-4 py-2 mb-2">
                Filtros extras
                @if ($this->isFiltering())
                    <x-button wire:click="clearFilters" icon="filter-x" color="rose" sm text="Limpar filtros" />
                @endif
            </div>
            <div class="grid grid-cols-12 gap-3">

                {{-- selects --}}
                @foreach (static::filterSelects() as $select)
                    @php
                        $select = (object) $select;
                    @endphp
                    <div class="col-span-6 sm:col-span-4 md:col-span-3 lg:col-span-2">
                        <x-select.native wire:model.live="selects.{{ $select->index }}" :options="$select->options"
                            label="{{ $select->label }}" select="label:label|value:value" />
                    </div>
                @endforeach

                {{-- between datas --}}
                @foreach (static::filterPeriods() as $period)
                    @php
                        $period = (object) $period;
                    @endphp
                    <div class="col-span-6 sm:col-span-4 md:col-span-3 lg:col-span-2 flex flex-col gap-y-3">
                        <x-input type="date" wire:model.live="periods.{{ $period->index }}.start"
                            label="{{ $period->label }}(Início)" />

                        <x-input type="date" wire:model.live="periods.{{ $period->index }}.end"
                            label="{{ $period->label }}(Fim)" />
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
