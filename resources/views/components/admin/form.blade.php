@props([
    'submitMethod' => null,
    'submitButtonText' => 'Submeter',
    'submitButtonIcon' => 'check',
])

@php
    throw_if(is_null($submitMethod), 'Requires a method name via prop "submitMethod"');
@endphp

<form wire:submit="{{ $submitMethod }}"
    {{ $attributes->merge([
        'class' => 'grid grid-cols-12 gap-6',
    ]) }}>
    {{ $slot }}

    <div class="col-span-12 flex justify-center gap-6">
        <x-button
            type="submit"
            wire:target="{{ $submitMethod }}"
            text="{{ $submitButtonText }}"
            icon="{{ $submitButtonIcon }}"
            loading />
    </div>
</form>
