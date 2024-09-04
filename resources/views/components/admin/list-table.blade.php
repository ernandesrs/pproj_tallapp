@props([
    'actionEdit' => null,
    'actionDelete' => false,
    'headers' => null,
    'rows' => null,
    'quantities' => [5, 10, 15, 20, 25],
])

@php
    throw_if(
        !is_null($actionEdit) && !is_callable($actionEdit),
        'actionEdit prop requires a callable returning a edit route.',
    );

    throw_if(!is_bool($actionDelete), 'actionDelete prop requires a boolean value');
@endphp

@if (!$this->simpleList)
    <div class="">
        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-3 md:col-span-2 xl:col-span-1">
                <x-select.native wire:model.live='quantity' label="Quantidade" :options="$quantities" />
            </div>
            <div class="col-span-2 md:col-span-5 xl:col-span-7"></div>
            <div class="col-span-7 md:col-span-5 xl:col-span-4 flex items-end gap-x-2">
                <div class="flex-1">
                    <x-input wire:model.debounce.live="search" label="Buscar..." placeholder="Buscar..." />
                </div>

                <x-button icon="filter" text="Mais filtros" color="zinc" />
            </div>
        </div>

        <div class="mt-4">
            <div
                class="bg-zinc-100 border dark:bg-zinc-800 dark:border-zinc-700 mb-5 rounded-md px-6 py-4">
                <div class="mb-1">Filtros extras</div>
                <div class="grid cols-12 gap-3">

                    jkla

                </div>
            </div>
        </div>
    </div>

    <div class="border px-6 py-4 dark:border-zinc-700 rounded-md">
        @if ($rows->count())
            @foreach ($rows as $row)
                <div class="">
                    {{ $row->first_name }}
                </div>
            @endforeach
        @else
            Sem items
        @endif
    </div>
@else
    <x-table :$headers :$rows :quantity="[5, 10, 15, 20]" filter paginate persistent loading>
        @interact('column_action', $row, $actionEdit, $actionDelete)
            @if (isset($actionEdit) && !is_null($actionEdit))
                @can('update', $row)
                    <x-button wire:navigate href="{{ $actionEdit($row) }}" text="Editar"
                        icon="edit"
                        color="primary" flat sm />
                @endcan
            @endif

            @if (isset($actionDelete) && !is_null($actionDelete))
                @can('delete', $row)
                    <x-admin.delete-confirmation
                        dialog-text="Você está excluindo o item com o <b>ID {{ $row->id }}</b> deste lista, confirme para continuar."
                        :confirm-param="$row->id" flat sm />
                @endcan
            @endif
        @endinteract
    </x-table>
@endif
