<x-admin.page
    :page="$page">
    <x-slot:actions>
        @can('create', \App\Models\User::class)
            <x-button wire:navigate href="{{ route('admin.users.create') }}" color="emerald" icon="plus" position="left">
                Novo usuário
            </x-button>
        @endcan
    </x-slot>

    <div class="col-span-12 grid grid-cols-12 gap-6">
        <div class="col-span-12 md:col-span-8 grid grid-cols-12 gap-6">
            <x-admin.content-card
                title="Dados básicos"
                class="col-span-12">
                <x-admin.form
                    submit-method="update"
                    submit-button-icon="user-check"
                    submit-button-text="Atualizar usuário"
                    class="grid-cols-12">
                    @include('livewire.admin.users.partials.basic-data-fields', ['edit' => true])
                </x-admin.form>
            </x-admin.content-card>
        </div>

        <div class="col-span-12 md:col-span-4 grid grid-cols-12 gap-6">
            <x-admin.content-card
                title="Avatar"
                class="col-span-12">
                <div class="flex justify-center items-center gap-6">
                    <div>
                        <x-admin.custom-avatar :avatar="$user->avatar" text="{{ $user->first_name }}" lg />
                    </div>

                    @if ($user->avatar)
                        <x-admin.delete-confirmation
                            confirm-method="deleteAvatar"
                            text="Excluir avatar"
                            dialog-text="Você está excluindo o avatar deste usuário, confirme para continuar?"
                            sm />
                    @endif
                </div>
            </x-admin.content-card>

            <x-admin.content-card
                title="Detalhes gerais"
                class="col-span-12">

                <div class="flex items-center gap-6">
                    <div class="flex-1 font-medium">
                        Verificado em:
                    </div>
                    <div class="flex-1">
                        {{ $user->email_verified_at ? $user->email_verified_at->format('d/m/Y H:i') : 'Não verificado' }}
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <div class="flex-1 font-medium">
                        Criado em:
                    </div>
                    <div class="flex-1">
                        {{ $user->created_at->format('d/m/Y H:i') }}
                    </div>
                </div>
            </x-admin.content-card>

            <x-admin.content-card title="Cargos" class="col-span-12">
                @can('updateUserRoles', $user)
                    <x-alert icon="shield-exclamation" color="amber" title="Importante!"
                        text="Muita atenção ao promover usuários, leia com cuidado as informações nas telas confirmação antes de confirmar."
                        outline />
                    <div class="flex mt-4">
                        <div class="flex flex-wrap gap-3">
                            @foreach (\App\Models\Role::all() as $aRole)
                                @php
                                    $hasRole = $user->hasRole($aRole);
                                @endphp
                                <x-button
                                    x-data="{
                                        ...{{ json_encode([
                                            'name' => $aRole->name,
                                            'promotion' => [
                                                'title' => 'Atribuindo o cargo ' . $aRole->display_name . ' ao usuário. Tem certeza?',
                                                'text' =>
                                                    $aRole->description .
                                                    ' <br /><br /> <b>Permissões deste cargo:</b><br />' .
                                                    \App\Models\Role::findByName($aRole->name)->permissions()->get()->map(fn($permission) => $permission->name)->join(', '),
                                            ],
                                            'demotion' => [
                                                'title' => 'Revogando o cargo ' . $aRole->display_name . '. Tem certeza?',
                                                'text' => 'O usuário perderá todas as permissões atreladas a este cargo.',
                                            ],
                                        ]) }},
                                        promotionConfirmation() {
                                            $interaction('dialog')
                                                .wireable()
                                                .warning(this.promotion.title, this.promotion.text)
                                                .confirm('Confirmar', 'updateRole', this.name)
                                                .cancel('Cancelar')
                                                .send();

                                        },
                                        demotionConfirmation() {
                                            $interaction('dialog')
                                                .wireable()
                                                .warning(this.demotion.title, this.demotion.text)
                                                .confirm('Confirmar', 'updateRole', this.name)
                                                .cancel('Cancelar')
                                                .send();

                                        }
                                    }"

                                    x-on:click="{{ $hasRole ? 'demotionConfirmation' : 'promotionConfirmation' }}"
                                    text="{{ $aRole->display_name }}"
                                    :color="$hasRole ? 'emerald' : 'light'"
                                    :outline="!$hasRole"
                                    :icon="$hasRole ? 'check' : 'plus'"
                                    sm />
                            @endforeach
                        </div>
                    </div>
                @else
                    @foreach ($user->roles()->get() as $role)
                        <x-badge text="{{ $role->display_name }}" color="emerald" />
                    @endforeach
                @endcan
            </x-admin.content-card>
        </div>
    </div>

</x-admin.page>
