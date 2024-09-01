<div class="w-full">
    <x-alert
        icon="{{ $success ? 'check' : 'x' }}"
        title="{{ $success ? 'Conta verificada!' : 'Falha na verificação!' }}"
        color="{{ $success ? 'emerald' : 'rose' }}"
        outline>
        @if ($success)
            Sua conta foi verificada com sucesso!
        @else
            A conta não existe ou o token de verificação é inválido. <b>Se você possui uma conta</b>, você pode <x-link
                wire:navigate href="{{ route('account.profile') }}" text="acessar seu perfil" /> e solicitar um novo link
            de verificação.
        @endif
    </x-alert>

    <div class="flex justify-center gap-5 mt-5">
        @if ($success)
            @auth
                <x-button
                    wire:navigate href="{{ route('account.profile') }}" icon="user-circle" text="Acesse seu perfil" />
            @else
                <x-button wire:navigate href="{{ route('auth.login') }}" icon="login" text="Faça login" />
            @endauth
        @endif
    </div>
</div>
