@props([
    'edit' => false,
])

<div class="col-span-12 sm:col-span-6">
    <x-input wire:model='first_name' label="Nome *" />
</div>

<div class="col-span-12 sm:col-span-6">
    <x-input wire:model='last_name' label="Sobrenome *" />
</div>

<div class="col-span-12 sm:col-span-6">
    <x-input wire:model='username' label="Usuário *" />
</div>

<div class="col-span-12 sm:col-span-6">
    <x-select.styled
        wire:model='gender'
        :options="[
            ['label' => 'Não definir', 'value' => 'n'],
            ['label' => 'Feminino', 'value' => 'f'],
            ['label' => 'Masculino', 'value' => 'm'],
        ]" select="label:label|value:value" label="Gênero *"
        placeholder='Selecione' />
</div>

<div class="col-span-12">
    <x-input wire:model='email' label="E-mail *" :readonly="$edit" />
</div>

<div class="col-span-12 sm:col-span-6">
    <x-password wire:model='password' label="Senha" />
</div>

<div class="col-span-12 sm:col-span-6">
    <x-password wire:model='password_confirmation' label="Confirmar senha" />
</div>
