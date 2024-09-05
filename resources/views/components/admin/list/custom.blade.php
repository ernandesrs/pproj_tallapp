@props([
    'headers' => [],
    'rows' => $rows,
    'actionEdit' => null,
    'actionDelete' => false,
])

@if ($rows->count())
    <div class="border dark:border-zinc-700 rounded-md w-full border-1 border-zinc-300 overflow-x-auto">
        <table
            class="table-auto w-full bg-zinc-100 dark:bg-zinc-700 text-left text-zinc-600 rounded-md overflow-hidden dark:text-zinc-200">
            <thead>
                <tr
                    class="bg-zinc-100 uppercase border-b text-sm font-medium border-b-zinc-200 dark:bg-zinc-700 dark:border-b-zinc-600">
                    @foreach ($headers as $header)
                        <td class="px-3 py-4">{{ $header['label'] }}</td>
                    @endforeach
                </tr>
            </thead>
            <tbody class="text-zinc-400">
                @foreach ($rows as $row)
                    <tr class="border-b border-b-zinc-200 bg-zinc-50 dark:border-b-zinc-700 dark:bg-zinc-800">
                        @foreach ($headers as $header)
                            @php
                                $index = $header['index'] ?? null;
                                $view = $header['view'] ?? null;
                                $callable = $header['callable'] ?? null;
                                $hasActions = $index == 'action';
                            @endphp
                            <td class="px-3 py-2">
                                @if (($index && $index != 'action') || $callable)
                                    {{ $index ? $row->$index : $callable($row) }}
                                @elseif ($view)
                                    @include($view, ['row' => $row])
                                @elseif ($hasActions)
                                    @include('components.admin.list.actions', [
                                        'actionEdit' => $actionEdit,
                                        'actionDelete' => $actionDelete,
                                    ])
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $rows->onEachSide(0)->links() }}
    </div>
@else
    Sem items
@endif
