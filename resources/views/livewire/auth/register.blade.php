<x-slot:title>
    Criar uma conta
</x-slot:title>

<x-slot:footer>
    <div class="flex justify-center gap-6 w-full">
        <x-link wire:navigate href="{{ route('auth.login') }}" text="Login" icon="login" />
    </div>
</x-slot:footer>

<div class="w-full">
    @include('livewire.auth.social-buttons', [
        'google' => false,
        'facebook' => false,
        'github' => false,
    ])

    <form wire:submit='register' class="grid grid-cols-12 gap-6">
        @include('livewire.admin.users.partials.basic-data-fields')

        <div class="col-span-12 flex flex-col justify-center gap-6">
            <x-button type="submit" icon="check" text="Criar conta" />
        </div>
    </form>
</div>
