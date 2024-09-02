<x-slot:title>
    Acesse sua conta
</x-slot:title>

<x-slot:footer>
    <div class="flex justify-center gap-6 w-full">
        <x-link wire:navigate href="{{ route('auth.forgotPassword') }}" text="Esquecia a senha" icon="arrow-up-right" />
        <x-link href="#" text="Criar conta" icon="user-plus" />
    </div>
</x-slot:footer>

<div class="w-full max-w-[425px]">
    @include('livewire.auth.social-buttons', [
        'google' => false,
        'facebook' => false,
        'github' => false,
    ])

    <form wire:submit='attempt' class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <x-input wire:model='email' label="E-mail *" />
        </div>

        <div class="col-span-12">
            <x-password wire:model='password' label="Senha *" />
        </div>

        <div class="col-span-12 flex flex-col justify-center gap-6">
            <x-checkbox wire:model='remember' label="Lembre-se de mim" />
            <x-button type="submit" icon="login" text="Login" />
        </div>
    </form>
</div>
