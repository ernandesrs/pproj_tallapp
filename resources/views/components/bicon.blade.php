@props([
    'name' => '',
])

<i class="bi bi-{{ empty($name) ? 'app' : $name }}" {{ $attributes }}></i>
