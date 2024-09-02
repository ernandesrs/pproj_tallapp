<x-mail::message>
# {{$userName}}, recupere sua senha.

Como solicitado, segue abaixo o seu link de recuperação de senha.

<x-mail::button url="{{$recoveryLink}}">
Recuperar senha
</x-mail::button>
{{$recoveryLink}}
<br>
<br>

Obrigado,<br>
{{ config('app.name') }}
</x-mail::message>
