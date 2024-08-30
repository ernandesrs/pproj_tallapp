@props([
    'role' => null,
])

<div class="col-span-12">
    <x-input wire:model="display_name" label="Nome do cargo *" />
</div>

@if (!$role)
    <div class="col-span-12">
        <x-input wire:model="name" label="Slug *" hint="Nome único e imutável para o cargo" :readonly="$role ? ($role->protected ? true : false) : false" />
    </div>
@endif

<div class="col-span-12">
    <x-textarea wire:model='description' label="Descrição" maxlength="255"
        hint="Descreva muito bem este cargo, pois servirá de guia para você." count resize />
</div>
