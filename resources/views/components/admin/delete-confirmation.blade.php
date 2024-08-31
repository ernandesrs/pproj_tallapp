@props([
    'title' => 'Tem certeza?',
    'text' => 'Você está excluindo este item desta lista, confirme para continuar.',
    'confirmMethod' => 'deleteItem',
    'confirmParam' => null,
])

<x-button
    x-data="{
        ...{{ json_encode([
            'id' => null,
            'dialog' => [
                'title' => $title,
                'text' => $text,
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

    x-on:click="deleteItem" text="Excluir" icon="trash" color="rose" {{ $attributes }} />
