@props([
    'rows' => $rows,
])

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
