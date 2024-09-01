<x-mail::message>
# Olá {{$userFullName}}!

Precisamos apenas que confirme a criação da sua conta, para isso você pode clicar no botão abaixo, vou copiar e colar o link no seu navegador.

<x-mail::button :url="$confirmationLink">
Confirmar
</x-mail::button>
{{$confirmationLink}}
<br>
<br>

Obrigado,<br>
{{ config('app.name') }}
</x-mail::message>
