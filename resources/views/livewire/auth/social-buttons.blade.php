@props([
    'google' => false,
    'facebook' => false,
    'github' => false,
])

<div class="flex flex-col justify-center gap-2 mb-6">
    @if ($google)
        <x-button icon="brand-google" text="Login com Google" color="ligth" />
    @endif
    @if ($facebook)
        <x-button icon="brand-facebook" text="Login com Facebook" color="ligth" />
    @endif
    @if ($github)
        <x-button icon="brand-github" text="Login com Github" color="ligth" />
    @endif
</div>
