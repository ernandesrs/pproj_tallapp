<x-slot:title>
    Recuperação de senha
</x-slot:title>

<div class="w-full max-w-[425px]">

    @if ($validToken)
        <form wire:submit='passwordReset' class="grid grid-cols-12 gap-6">
            <div class="col-span-12">
                <x-password wire:model='password' label="Senha *" placeholder="Senha" />
            </div>
            <div class="col-span-12">
                <x-password wire:model='password_confirmation' label="Confirmar senha *" placeholder="Confirmar senha" />
            </div>

            <div class="col-span-12 flex flex-col justify-center gap-6">
                <x-button type="submit" icon="check" text="Atualizar senha" />
            </div>
        </form>
    @else
        <div class="flex flex-col items-center gap-3">
            <x-alert icon="x" title="Oops!" text="Parece que o token de recuperação de senha é inválido."
                color="rose" outline />

            <x-link wire:navigate href="{{ route('auth.forgotPassword') }}" icon="arrow-up-right"
                text="Solicitar um novo link de recuperação" color="rose" underline />
        </div>
    @endif
</div>
