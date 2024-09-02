<x-slot:title>
    Esqueci a senha
</x-slot:title>

<x-slot:footer>
    <div class="flex justify-center gap-6 w-full">
        <x-link wire:navigate href="{{ route('auth.login') }}" text="Login" icon="login" />
        <x-link href="#" text="Criar conta" icon="user-plus" />
    </div>
</x-slot:footer>

<div class="w-full max-w-[425px]">
    <form wire:submit='requestRecoveryLink' class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <x-input wire:model='email' label="E-mail *" placeholder="E-mail" />
        </div>

        <div class="col-span-12 flex flex-col justify-center gap-6">
            <x-button type="submit" icon="check" text="Solicitar link" />
        </div>
    </form>
</div>
