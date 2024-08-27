@props([
    'name' => '',
])

<i {{ $attributes->merge([
    'class' => 'bi bi-' . (empty($name) ? 'app' : $name),
]) }}></i>
