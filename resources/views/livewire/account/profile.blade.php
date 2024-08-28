<x-admin.page
    title="Meu perfil">

    <div class="col-span-12 md:col-span-4 grid gap-6">
        <x-admin.content-card
            icon="user-circle"
            title="Seu avatar"
            class="col-span-12">
            <div class="flex flex-col gap-y-3">
                <div class="flex-1 flex items-center gap-5">
                    @if (!empty($user->avatar))
                        <x-avatar
                            :image="\Str::startsWith($user->avatar, ['http://', 'https://'])
                                ? $user->avatar
                                : \Storage::url($user->avatar)" lg />
                    @else
                        <x-avatar text="{{ $user->username[0] }}" lg />
                    @endif

                    <div class="flex-1">
                        <x-upload wire:model="avatar" delete delete-method="deleteAvatar"
                            accept="image/*" placeholder="Novo avatar" tip="Arraste e solte sua foto aqui">
                            <x-slot:footer when-uploaded>
                                <div class="w-full flex justify-center">
                                    <x-button wire:target="updateAvatar" wire:click='updateAvatar' text="Atualizar" />
                                </div>
                            </x-slot:footer>
                        </x-upload>
                    </div>
                </div>
            </div>
        </x-admin.content-card>

        <x-admin.content-card
            icon="list-letters"
            title="Detalhes"
            class="col-span-12">
            Some account details
        </x-admin.content-card>
    </div>

    <div class="col-span-12 md:col-span-8 grid gap-6">
        <x-admin.content-card
            icon="id"
            title="Profile data"
            class="col-span-12">

            <div class="grid grid-cols-12 gap-6">
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

                <div class="col-span-12 sm:col-span-6">
                    <x-password wire:model='password' label="Senha" />
                </div>

                <div class="col-span-12 sm:col-span-6">
                    <x-password wire:model='password_confirmation' label="Confirmar senha" />
                </div>

                <div class="col-span-12 flex justify-center">
                    <x-button wire:target="updateProfile" wire:click="updateProfile" text="Atualizar" icon="check"
                        loading />
                </div>
            </div>
        </x-admin.content-card>
    </div>

</x-admin.page>
