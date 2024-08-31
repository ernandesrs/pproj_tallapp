@props([
    'dialogTitle' => 'Tem certeza?',
    'dialogText' => 'Você está excluindo este item desta lista, confirme para continuar.',
    'confirmMethod' => 'deleteItem',
    'confirmParam' => null,
])

@php
    if (!$attributes->has('text')) {
        $attributes = $attributes->merge([
            'text' => 'Excluir',
        ]);
    }
@endphp

<x-button
    x-data="{
        ...{{ json_encode([
            'id' => null,
            'dialog' => [
                'title' => $dialogTitle,
                'text' => $dialogText,
                'confirmMethod' => $confirmMethod,
                'confirmParam' => $confirmParam,
            ],
        ]) }},

        deleteItem() {
            $interaction('dialog')
                .wireable()
                .warning(this.dialog.title, this.dialog.text)
                .confirm('Confirmar', this.dialog.confirmMethod, this.dialog.confirmParam)
                .cancel('Cancelar')
                .send();
        }
    }"

    x-on:click="deleteItem" icon="trash" color="rose" {{ $attributes }} />
