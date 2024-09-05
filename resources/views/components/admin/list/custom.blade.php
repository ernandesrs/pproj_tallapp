@props([
    'headers' => [],
    'rows' => $rows,
    'actionEdit' => null,
    'actionDelete' => false,
])

<div class="border px-6 py-4 dark:border-zinc-700 rounded-md">
    @if ($rows->count())
        <table>
            <thead>
                <tr>
                    @foreach ($headers as $header)
                        <th>{{ $header['label'] }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                    <tr>
                        @foreach ($headers as $header)
                            @php
                                $index = $header['index'] ?? null;
                                $view = $header['view'] ?? null;
                                $callable = $header['callable'] ?? null;
                                $hasActions = $index == 'action';
                            @endphp
                            <td>
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
    @else
        Sem items
    @endif
</div>
