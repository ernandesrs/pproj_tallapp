@props([
    'avatar' => null,
    'text' => 'Avatar',
])

<x-avatar
    image="{{ $avatar ? (\Str::startsWith($avatar, ['https://', 'http://']) ? $avatar : \Storage::url($avatar)) : null }}"
    text="{{ $text[0] }}" {{ $attributes }} />
